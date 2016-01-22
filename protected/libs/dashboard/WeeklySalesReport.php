<?php

use Carbon\Carbon;

class WeeklySalesReport {
    /**
     *
     * @return int
     */
    public function getCurrentWeekSales()
    {
        $sumReporter = new SumReportFetcher;
        $monday =  Carbon::parse('monday this week');
        $sunday =  Carbon::parse('sunday this week');
        return $sumReporter->getSumReport((string) $monday, (string) $sunday);
    }

}