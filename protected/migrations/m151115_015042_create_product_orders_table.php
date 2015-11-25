<?php

class m151115_015042_create_product_orders_table extends CDbMigration
{


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        /*create tbl_product_orders*/
        $this->createTable("tbl_product_orders", array(
            'id'=>"pk",
            'order_id'=>"integer",
            'product_id'=>"integer",
            'quantity'=>"integer",
            'date_created'=>"datetime",
            'date_updated'=>"datetime"
        ));
        /* orders foreign key */
        $this->addForeignKey("orders_fk", "tbl_product_orders", "order_id", "tbl_orders", "id", "CASCADE", "CASCADE");
        /* products foreign key */
        $this->addForeignKey("products_fk", "tbl_product_orders", "product_id", "tbl_product", "id", "CASCADE", "CASCADE");

	}

	public function safeDown()
	{
        $this->dropForeignKey("orders_fk", "tbl_product_orders");
        $this->dropForeignKey("products_fk", "tbl_product_orders");
        $this->dropTable("tbl_product_orders");
	}

}