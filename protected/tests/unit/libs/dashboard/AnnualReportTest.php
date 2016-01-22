<?php 

use Carbon\Carbon;
/**
* AnnualReportTest
*/
class AnnualReportTest extends CDbTestCase
{
	public $annualReport;
	public function setUp()
	{
		$this->annualReport = new AnnualReport;
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
	public function testGetAnnualMonthlyReport()
	{
		/*insert last month*/
		foreach (range(0, 5) as $key => $value) {
			/*insert 5 orders row*/
			$newOrder = new Orders();
			$newOrder->paid = 5000.00;
			$newOrder->order_date = (string) Carbon::parse('monday last month');
			$newOrder->save(false);
		}
		foreach (range(0, 5) as $key => $value) {
			/*insert 5 orders row*/
			$newOrder = new Orders();
			$newOrder->paid = 5000.00;
			$newOrder->order_date = (string) Carbon::parse('monday this month');
			$newOrder->save(false);
		}
		/*insert this month*/
		$reportArr = $this->annualReport->getAnnualMonthlyReport();

		/*check if Month is complete*/
		
		$this->assertNotNull($reportArr['January'], 'Check if January is in the report');
		$this->assertNotNull($reportArr['February'], 'Check if February is in the report');
		$this->assertNotNull($reportArr['March'], 'Check if March is in the report');
		$this->assertNotNull($reportArr['April'], 'Check if April is in the report');
		$this->assertNotNull($reportArr['May'], 'Check if May is in the report');
		$this->assertNotNull($reportArr['June'], 'Check if June is in the report');
		$this->assertNotNull($reportArr['July'], 'Check if July is in the report');
		$this->assertNotNull($reportArr['August'], 'Check if August is in the report');
		$this->assertNotNull($reportArr['September'], 'Check if September is in the report');
		$this->assertNotNull($reportArr['October'], 'Check if October is in the report');
		$this->assertNotNull($reportArr['November'], 'Check if November is in the report');
		$this->assertNotNull($reportArr['December'], 'Check if December is in the report');

		$this->assertEquals($reportArr['October'], 30000, 'Make sure total is 30000');
		$this->assertEquals($reportArr['November'], 30000, 'Make sure total is 30000');
	}
}