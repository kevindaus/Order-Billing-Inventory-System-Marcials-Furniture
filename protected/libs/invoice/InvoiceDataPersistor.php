<?php

class InvoiceDataPersistor {
    protected $rawPostedData = null;
    protected $orderModel = null;
    protected $customerModel = null;
    protected $orderProducts = array();
    function __construct($rawPostedData)
    {
        $this->rawPostedData = $rawPostedData;
    }

    /**
     * @return mixed
     */
    public function getCustomerModel()
    {
        return $this->customerModel;
    }

    /**
     * @param mixed $customerModel
     */
    public function setCustomerModel($customerModel)
    {
        $this->customerModel = $customerModel;
    }


    /**
     * @return mixed
     */
    public function getOrderModel()
    {
        return $this->orderModel;
    }

    /**
     * @param mixed $orderModel
     */
    public function setOrderModel($orderModel)
    {
        $this->orderModel = $orderModel;
    }

    /**
     * @return array
     */
    public function getOrderProducts()
    {
        return $this->orderProducts;
    }

    /**
     * @param array $orderProducts
     */
    public function setOrderProducts($orderProducts)
    {
        $this->orderProducts = $orderProducts;
    }

    /**
     * @return mixed
     */
    public function getRawPostedData()
    {
        return $this->rawPostedData;
    }

    /**
     * @param mixed $rawPostedData
     */
    public function setRawPostedData($rawPostedData)
    {
        $this->rawPostedData = $rawPostedData;
    }

    /**
     * Saves the passed posted data
     */
    public function save(){
        /**
         * @var Orders $ordersModel
         * @var Customer $customerModel
         */
        /*Save customer information */
        $customerModel = $this->saveCustomerInformation($this->rawPostedData);
        $this->setCustomerModel($customerModel);
        /*Save orders*/
        $ordersModel = $this->saveOrders($customerModel,$this->rawPostedData);
        $this->setOrderModel($ordersModel);
        /*@TODO - save product orders*/
        $productOrders[] = $this->saveProductOrders($ordersModel,$this->rawPostedData['orderInformation']['ordered_products']);
        $this->setOrderProducts($productOrders);
    }

    /**
     *
     * @param Customer $cust
     * @param $ordersInfo
     * @throws Exception
     * @return Orders
     */
    public function saveOrders(Customer $cust,$ordersInfo){
        $currentOrder = new Orders();
        $currentOrder->customer_id = $cust->id;
        $currentOrder->sub_total =  $ordersInfo['orderInformation']['sub_total'];
        $currentOrder->tax =  $ordersInfo['orderInformation']['tax'];
        $currentOrder->shipping_amt =  $ordersInfo['orderInformation']['shipping'];
        $currentOrder->total_amt =  $ordersInfo['orderInformation']['total'];
        $currentOrder->paid =  $ordersInfo['orderInformation']['paid'];
        $currentOrder->sales_person =  $ordersInfo['orderInformation']['sales_person'];
        $currentOrder->invoice_number=  $ordersInfo['orderInformation']['invoice_number'];
        $_shippingAddress = sprintf(
            "%s , %s ,%s , %s",
            $ordersInfo['shippingAddress']['shipping_address_street'],
            $ordersInfo['shippingAddress']['shipping_address_city'],
            $ordersInfo['shippingAddress']['shipping_address_province'],
            $ordersInfo['shippingAddress']['shipping_address_country']
        );
        $currentOrder->shipping_address =  $_shippingAddress;
        $currentOrder->note =  $ordersInfo['orderInformation']['notes'];

        $shippingDateObj = strtotime($ordersInfo['orderInformation']['ship_date']);
        $currentOrder->ship_date =  date("Y-m-d H:i:s",$shippingDateObj);


        $orderDateObj = strtotime($ordersInfo['orderInformation']['order_date']);
        $currentOrder->order_date =  date("Y-m-d H:i:s",$orderDateObj);
        if (!$currentOrder->save()) {
            throw new Exception("Failed to save current order. Reason : " . CHtml::errorSummary($currentOrder));
        }
        return $currentOrder;
    }

    /**
     *
     * @param Orders $orders
     * @param array $productList
     * @return array
     */
    private function saveProductOrders(Orders $orders,$productList = array())
    {
        $productOrders = array();
        /*iterate products*/
        foreach ($productList as $currentProduct) {
            /**
             * @var Product $productModel
             */
            $newProductOrder = new ProductOrders();
            $newProductOrder->order_id = $orders->id;
            $productModel = Product::model()->findByAttributes(array("name" => $currentProduct['product_name']));
            $newProductOrder->product_id = $productModel->id;
            $newProductOrder->quantity = intval($currentProduct['quantity']);
            if ($newProductOrder->save()) {
                /*decrease quantity of product*/
                $productModel->quantity -= intval($currentProduct['quantity']);
                $productModel->save();
            }
            /*add to collection */
            $productOrders[] = $newProductOrder;
        }
        return $productOrders;
    }

    private function saveCustomerInformation($rawPostedData)
    {
        $customerModel = new Customer();
        $customerModel->title = $rawPostedData['customerModel']['title'];
        $customerModel->firstname = $rawPostedData['customerModel']['firstname'];
        $customerModel->middlename = $rawPostedData['customerModel']['middlename'];
        $customerModel->lastname = $rawPostedData['customerModel']['lastname'];
        $customerModel->contactNumber = $rawPostedData['customerModel']['contact_number'];
        if (!$customerModel->save()) {
            throw new Exception("Cant save the new customer . Reason : " . CHtml::errorSummary($customerModel));
        }
        return $customerModel;

    }


} 