<?php


class InvoiceDataPersistorTest extends CDbTestCase
{
    public $customerModel;
    public $invoiceDataPersistor;
    protected $productModels = array();
    protected $ordersModel;

    protected function setUp()
    {
        $firstProduct = new Product();
        $firstProduct->name = "wooden chair 2x";
        $firstProduct->description = "a wooden chair made of wood";
        $firstProduct->quantity = 50;
        $firstProduct->price = 3000;
        $firstProduct->sku = uniqid();
        if (!$firstProduct->save()) {
            throw new Exception(CHtml::errorSummary($firstProduct));
        }else{
            $this->productModels[] = $firstProduct;
        }
        $secondProduct = new Product();
        $secondProduct->name = "wooden chair 3x";
        $secondProduct->description = "a wooden chair made of wood but with color";
        $secondProduct->quantity = 60;
        $secondProduct->price = 4000;
        $secondProduct->sku = uniqid();
        if (!$secondProduct->save()) {
            throw new Exception(CHtml::errorSummary($secondProduct));
        }else{
            $this->productModels[] = $secondProduct;
        }
        /*create  product model*/
        parent::setUp();
    }

    /*
     * Remove inserted data and revert back the changes from the database
     * */
    protected function tearDown()
    {
        /*delete all productOrders*/
        ProductOrders::model()->deleteAll();
        /*delete all products*/
        Product::model()->deleteAll();
        /*delete all orders*/
        Orders::model()->deleteAll();
        /*delete all customers*/
        Customer::model()->deleteAll();


        parent::tearDown();
    }

    /*
     *
     * Test saving of invoice data
     *
     * */
    public function testSave()
    {
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
                        "quantity" => "30",
                        "unit_price" => "3000",
                        "line_total" => " 230",
                    ),
                    array(
                        "product_name" => "wooden chair 3x",
                        "description" => "a wooden chair made of wood but with color",
                        "quantity" => "20",
                        "unit_price" => "4000",
                        "line_total" => "230",
                    )
                ),
                "sub_total" => "6230",
                "tax" => "0.5",
                "shipping" => "2",
                "total" => "6263.15",
                "paid" => "6264",
                "change" => "0.85000000000036"
            ),
            "customerModel" => array(
                "title" => "Mr",
                "firstname" => "john",
                "middlename" => "middle",
                "lastname" => "doe",
                "contact_number" => "09069148369",
            )
        );
        $firstProduct = Product::model()->findByAttributes(array("name" => $rawPostedData['orderInformation']['ordered_products'][0]['product_name']));
        $firstProductCountBefore = intval($firstProduct->quantity);
        $secondProduct = Product::model()->findByAttributes(array("name" => $rawPostedData['orderInformation']['ordered_products'][1]['product_name']));
        $secondProductCountBefore = intval($secondProduct->quantity);

        $this->invoiceDataPersistor =new InvoiceDataPersistor($rawPostedData);
        $this->invoiceDataPersistor->save();

        $firstProduct = Product::model()->findByAttributes(array("name" => $rawPostedData['orderInformation']['ordered_products'][0]['product_name']));
        $firstProductCountAfter = intval($firstProduct->quantity);
        $secondProduct = Product::model()->findByAttributes(array("name" => $rawPostedData['orderInformation']['ordered_products'][1]['product_name']));
        $secondProductCountAfter = intval($secondProduct->quantity);


        /*check orders detail if valid*/
        /**
         * @var Orders $orderModel
         */
        /*check shipping date*/
        $this->ordersModel = $this->invoiceDataPersistor->getOrderModel();
        $shipDatePosted = strtotime($rawPostedData['orderInformation']['ship_date']);
        $shipDatePostedStr = date("Y-m-d H:i:s", $shipDatePosted);
        $this->assertEquals($shipDatePostedStr, $this->ordersModel->ship_date, "Assert that shipping date is properly inserted in the database");

        $this->assertEquals($this->ordersModel->invoice_number, $rawPostedData['orderInformation']['invoice_number'], "Assert that the invoice number is inserted in the database");

        /*check order date*/
        $orderDatePosted = strtotime($rawPostedData['orderInformation']['order_date']);
        $orderDatePostedStr = date("Y-m-d H:i:s", $orderDatePosted);
        $this->assertEquals($orderDatePostedStr, $this->ordersModel->order_date, "Assert that order date is properly saved in the database");

        /*check if product quantity is reduced*/
        $this->assertEquals($firstProductCountBefore - intval($rawPostedData['orderInformation']['ordered_products'][0]['quantity']),
            $firstProductCountAfter, "Assert that first product quantity is actually reduced");

        /*check if product quantity is reduced*/
        $this->assertEquals($secondProductCountBefore - intval($rawPostedData['orderInformation']['ordered_products'][1]['quantity']),
            $secondProductCountAfter, "Assert that second product quantity is actually reduced");
        /*check if ordered is saved*/
        $this->assertNotNull($this->invoiceDataPersistor->getOrderModel(), "Assert that the order is saved");

        /*check if customer record is record*/
        /**
         * @var Customer $customerModel
         */
        $this->customerModel =$this->invoiceDataPersistor->getCustomerModel();
        $this->assertNotNull($this->customerModel, "Assert that the customer is saved");

        $this->assertEquals($this->customerModel->contactNumber, $rawPostedData['customerModel']['contact_number'], "Assert that
        the mobile number of custom is inserted");


        /*Check if ordered products are saved*/
        $this->assertNotEquals(array(), $this->invoiceDataPersistor->getOrderProducts(),
            "Assert that the product orders are saved");
    }
}
 