<?php


class CreateInvoiceForm extends CFormModel{
    public $PO_number;
    public $sales_person;
    public $ship_date;
    public $order_date;
    public $products = array();//list of ordered products
    public $sub_total;
    public $tax;
    public $shipping_amt;
    public $total;
    public $paid;
    public $total_due;

    public function attributeLabels()
    {
        return array(
            "PO_number" => "PO Number",
            "sales_person"  => "Sales Person",
            "ship_date" => "Ship Date",
            "order_date"    => "Order Date",
            "products"  => "Products",
            "sub_total" => "Sub Total",
            "tax"   => "Tax",
            "shipping_amt"  => "Shipping Amount",
            "total" => "Total",
            "paid"  => "Paid",
            "total_due" => "Total Due",
        );
    }

}