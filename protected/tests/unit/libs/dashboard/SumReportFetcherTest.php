<?php 
/**
* SumReportFetcherTest
*/
use Carbon\Carbon;
class SumReportFetcherTest extends CDbTestCase 
{
	public $insertedOrders = array();
	public $totalPaid;
	public function setUp()
	{
        /*delete all productOrders*/
        ProductOrders::model()->deleteAll();
        /*delete all products*/
        Product::model()->deleteAll();
        /*delete all orders*/
        Orders::model()->deleteAll();
        /*delete all customers*/
        Customer::model()->deleteAll();

	}
	public function tearDown()
	{
        /*delete all productOrders*/
        ProductOrders::model()->deleteAll();
        /*delete all products*/
        Product::model()->deleteAll();
        /*delete all orders*/
        Orders::model()->deleteAll();
        /*delete all customers*/
        Customer::model()->deleteAll();

	}
	public function testSumReportThisWeek()
	{
		$this->totalPaid = 0;
		foreach (range(0, 5) as $key => $value) {
			/*insert 5 orders row*/
			$newOrder = new Orders();
			$newOrder->paid = 5000.00;
			$newOrder->order_date = date("Y-m-d H:i:s");
			if ($newOrder->save(false)) {
				$this->totalPaid += doubleval($newOrder->paid);
				$this->insertedOrders[] = $newOrder;
			}
		}
		/*get total for this week */
		$tempTotalContainer = 0;
		$sumReportFetcher = new SumReportFetcher;
		$monday =  Carbon::parse('monday this week');
		$sunday =  Carbon::parse('sunday this week');
		$tempTotalContainer = $sumReportFetcher->getSumReport((string)$monday,(string)$sunday);
		$this->assertEquals($tempTotalContainer, $this->totalPaid, "Assert all test paid data are inserted");
	}
	
	public function testSumReportLastWeek()
	{

		$this->totalPaid = 0;
		foreach (range(0, 6) as $key => $value) {
			/*insert 5 orders row*/
			$newOrder = new Orders();
			$newOrder->paid = 5000.00;
			$newOrder->order_date = (string) Carbon::parse('wednesday last week');;
			if ($newOrder->save(false)) {
				$this->totalPaid += doubleval($newOrder->paid);
			}
		}
		/*get total for this week */
		$tempTotalContainer = 0;
		$sumReportFetcher = new SumReportFetcher;
		$mondayLastWeek =  Carbon::parse('monday last week');
		$sundayLastWeek =  Carbon::parse('sunday last week');
		$tempTotalContainer = $sumReportFetcher->getSumReport((string)$mondayLastWeek,(string)$sundayLastWeek);
		$this->assertEquals($tempTotalContainer, $this->totalPaid, "Assert all test paid data are inserted and last week report are valid");
	}

	public function testSumReportThisMonth()
	{

		$this->totalPaid = 0;
		foreach (range(0, 6) as $key => $value) {
			/*insert 5 orders row*/
			$newOrder = new Orders();
			$newOrder->paid = 5000.00;
			$newOrder->order_date = (string) Carbon::parse('wednesday last week');;
			if ($newOrder->save(false)) {
				$this->totalPaid += doubleval($newOrder->paid);
			}
		}		
		foreach (range(0, 5) as $key => $value) {
			/*insert 5 orders row*/
			$newOrder = new Orders();
			$newOrder->paid = 5000.00;
			$newOrder->order_date = date("Y-m-d H:i:s");
			if ($newOrder->save(false)) {
				$this->totalPaid += doubleval($newOrder->paid);
				$this->insertedOrders[] = $newOrder;
			}
		}
        $sumReporter = new SumReportFetcher;
        $firstDayOfMonth =  Carbon::parse('first day of this month');
        $lastDayOfMonth =  Carbon::parse('last day of this month');
        $tempContainer =  $sumReporter->getSumReport((string) $firstDayOfMonth, (string) $lastDayOfMonth);
        $tempContainer = doubleval($tempContainer);
        $this->assertEquals($tempContainer , $this->totalPaid,"Asserting that the total for this month is equal to my calculated total this month. ");


	}


}
