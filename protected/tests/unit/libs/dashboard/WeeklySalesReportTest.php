<?php

/**
 * Class WeeklySalesReportTest
 * @property WeeklySalesReport $weeklySalesReport
 */
class WeeklySalesReportTest extends CDbTestCase {

    public $weeklySalesReport;
    public $totalPaid = 0;
    public $invoiceDataPersistor = array();
    protected function setUp()
    {
        $this->weeklySalesReport = new WeeklySalesReport();
        /*delete all productOrders*/
        ProductOrders::model()->deleteAll();
        /*delete all products*/
        Product::model()->deleteAll();
        /*delete all orders*/
        Orders::model()->deleteAll();
        /*delete all customers*/
        Customer::model()->deleteAll();


        $firstProduct = new Product();
        $firstProduct->name = "wooden chair 2x";
        $firstProduct->description = "a wooden chair made of wood";
        $firstProduct->quantity = 300;
        $firstProduct->price = 3000;
        $firstProduct->sku = uniqid();
        if (!$firstProduct->save()) {
            throw new Exception(CHtml::errorSummary($firstProduct));
        }
        $secondProduct = new Product();
        $secondProduct->name = "wooden chair 3x";
        $secondProduct->description = "a wooden chair made of wood but with color";
        $secondProduct->quantity = 200;
        $secondProduct->price = 4000;
        $secondProduct->sku = uniqid();
        if (!$secondProduct->save()) {
            throw new Exception(CHtml::errorSummary($secondProduct));
        }
        $thirdProduct = new Product();
        $thirdProduct->name = "Banana Chair";
        $thirdProduct->description = "A chair that is shaped like a banana";
        $thirdProduct->quantity = 500;
        $thirdProduct->price = 3000;
        $thirdProduct->sku = uniqid();
        if (!$thirdProduct->save()) {
            throw new Exception(CHtml::errorSummary($thirdProduct));
        }


        parent::setUp();
    }

    protected function tearDown()
    {
//        /*delete all productOrders*/
        ProductOrders::model()->deleteAll();
        /*delete all products*/
        Product::model()->deleteAll();
        /*delete all orders*/
        Orders::model()->deleteAll();

        parent::tearDown();
    }
    public function testGetCurrentWeekSales()
    {
        foreach (range(0,5) as $index=>$value) {
            $this->invoiceDataPersistor[] = $this->insertSampleRecord();
        }
        $currentWeekSale = $this->weeklySalesReport->getCurrentWeekSales();
        $this->assertEquals($this->totalPaid  ,$currentWeekSale );
    }
    private function insertSampleRecord(){
        $rawPostedData = array(
            "shippingAddress" => array(
                "shipping_address_street" => "#018 Gaddang Street Barangay Quirino",
                "shipping_address_city" => "Solano",
                "shipping_address_province" => "Nueva Vizcaya",
                "shipping_address_country" => "Philippines"
            ),
            "orderInformation" => array(
                "notes" => "this is a random note . heres a proof . " . uniqid(),
                "invoice_number" => uniqid(),
                "sales_person" => "Marcials Furniture",
                "ship_date" => "November 25,2015",
                "order_date" => "November 23,2015",
                "ordered_products" => array(
                    array(
                        "product_name" => "wooden chair 2x",
                        "description" => "a wooden chair made of wood",
                        "quantity" => 10,
                        "unit_price" => 3000,
                        "line_total" => 30000,
                    ),
                    array(
                        "product_name" => "wooden chair 3x",
                        "description" => "a wooden chair made of wood but with color",
                        "quantity" => 20,
                        "unit_price" => 4000,
                        "line_total" => 80000,
                    ),
                    array(
                        "product_name" => "Banana Chair",
                        "description" => "A chair that is shaped like a banana",
                        "quantity" => 10,
                        "unit_price" => 3000,
                        "line_total" => 30000,
                    ),
                ),
                "sub_total" => 140000,
                "tax" => 0.5,
                "shipping" => 2,
                "total" => 140702,
                "paid" => 141000,
                "change" => 298
            ),
            "customerModel" => array(
                "title" => "Mr",
                "firstname" => "john ".Customer::model()->count(),
                "middlename" => "middle ".Customer::model()->count(),
                "lastname" => "doe ".Customer::model()->count(),
                "contact_number" => "09069148369",
            )
        );
        $this->totalPaid += 141000;
        $invoiceDataPersistor =new InvoiceDataPersistor($rawPostedData);
        $invoiceDataPersistor->save();
        return $invoiceDataPersistor;
    }


}
