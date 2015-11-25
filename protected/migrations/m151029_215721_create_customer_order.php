<?php

class m151029_215721_create_customer_order extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_orders",array(
				"id"=>"pk",
				"customer_id"=>"integer",
				"invoice_number"=>"string",
				"sub_total"=>"double",//total of all products ordered
				"tax"=>"double",// in percentage 5.0 %
				"shipping_amt"=>"double",// bayad ng shipping
				"total_amt"=>"double",//sub_total + tax + shipping_amt
				"paid"=>"double",//amount paid by customer
				"change"=>"double",//total_amt - paid
				"sales_person"=>"string",//defaults to params['owner'']
				"shipping_address"=>"string",//
				"ship_date"=>"datetime",
				"note"=>"text",
				"order_date"=>"datetime",
				"date_created"=>"datetime",
				"date_updated"=>"datetime",
			));
		$this->addForeignKey("custom_orders_fk", "tbl_orders", "customer_id", "tbl_customer", "id", "CASCADE", "CASCADE");
	}
	public function safeDown()
	{
		$this->dropForeignKey("custom_orders_fk", "tbl_orders");
		$this->dropTable("tbl_orders");
	}
}