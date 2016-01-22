<?php


use Carbon\Carbon;
class SiteController extends Controller
{


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('error','login','logout','test'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$weeklySalesReport = new WeeklySalesReport;
		$thisWeeksSale = $weeklySalesReport->getCurrentWeekSales();

		$monthlySalesReport = new MonthlySalesReport;
		$wholeMonthSale = $monthlySalesReport->getThisMonthsReport();

		$annualReportObj = new AnnualReport;
		$annualMonthlyReport = $annualReportObj->getAnnualMonthlyReport();

		$productModel=new Product('search');
		$productModel->unsetAttributes();
		if(isset($_GET['Product'])){
			$productModel->attributes=$_GET['Product'];
		}

		$materialModel=new Materials('search');
		$materialModel->unsetAttributes();
		if(isset($_GET['Materials'])){
			$materialModel->attributes=$_GET['Materials'];		
		}
		$this->render('index',
			compact(
				'productModel',
				'materialModel',
				'thisWeeksSale',
				'wholeWeekReport',
				'wholeMonthSale',
				'annualMonthlyReport'
			)
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->redirect(array('user/login'));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$this->redirect(array('user/logout'));
	}

	public function actionTest()
	{
		$yearToday = date("Y");
		$monthName = "February";
		$dateFromStr = sprintf("first day of %s %s", $monthName , $yearToday);
		$dateToStr = sprintf("last day of %s %s", $monthName,$yearToday);
		var_dump((string) Carbon::parse($dateFromStr));
		var_dump((string) Carbon::parse($dateToStr));
	}
}