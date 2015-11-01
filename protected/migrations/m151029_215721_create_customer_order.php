<?php

class m151029_215721_create_customer_order extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_orders",array(
				"id"=>"pk",
				"customer_id"=>"integer",
				"product_id"=>"integer",
				"quantity"=>"integer",
				"tax"=>"double",
				"total"=>"double",
				"balance"=>"double",
				"status"=>"status",
				"date_created"=>"datetime",
				"date_updated"=>"datetime",
			));

		$this->addForeignKey("product_orders_fk", "tbl_orders", "product_id", "tbl_product", "id", "CASCADE", "CASCADE");
		$this->addForeignKey("custom_orders_fk", "tbl_orders", "customer_id", "tbl_customer", "id", "CASCADE", "CASCADE");
	}
	public function safeDown()
	{
		$this->dropForeignKey("product_orders_fk", "tbl_orders");
		$this->dropForeignKey("custom_orders_fk", "tbl_orders");
		$this->dropTable("tbl_orders");
	}
}