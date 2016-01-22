<?php 
use Carbon\Carbon;
/**
* AnnualReport
*/
class AnnualReport
{
	public function getAnnualMonthlyReport()
	{
		$reportArr = array(
				'January'=>0,
				'February'=>0,
				'March'=>0,
				'April'=>0,
				'May'=>0,
				'June'=>0,
				'July'=>0,
				'August'=>0,
				'September'=>0,
				'October'=>0,
				'November'=>0,
				'December'=>0,
			);
		$monthlySalesReporter = new SumReportFetcher;
		foreach ($reportArr as $key => $value) {
			$yearToday = date("Y");
			$dateFromStr = sprintf("first day of %s %s", $key , $yearToday);
			$dateToStr = sprintf("last day of %s %s", $key,$yearToday);
			$dateFrom = (string) Carbon::parse($dateFromStr);
			$dateTo = (string) Carbon::parse($dateToStr);
			$reportArr[$key] = $monthlySalesReporter->getSumReport($dateFrom ,$dateTo);
		}
		return $reportArr;
	}
}