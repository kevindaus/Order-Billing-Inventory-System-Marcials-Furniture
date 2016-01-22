<?php 
use Carbon\Carbon;
/**
* MonthlySalesReport
*/
class MonthlySalesReport
{
	public function getThisMonthsReport()
	{
        $sumReporter = new SumReportFetcher;
        $firstDayOfMonth =  Carbon::parse('first day of this month');
        $lastDayOfMonth =  Carbon::parse('last day of this month');
        return $sumReporter->getSumReport((string) $firstDayOfMonth, (string) $lastDayOfMonth);
	}
}