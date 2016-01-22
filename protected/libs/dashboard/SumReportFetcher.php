<?php 

/**
* SumReportFetcher
*/
class SumReportFetcher
{
	
	public function getSumReport($dateFrom ,$dateTo)
	{
        $sum = 0;
        $res = Yii::app()->db->createCommand("select sum(paid) 'sum' from tbl_orders where order_date between '$dateFrom' and '$dateTo'")->queryRow();
        $sum = doubleval($res['sum']);
        return $sum;	
	}


}