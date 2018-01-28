<?php

class m151029_215707_create_product_table extends CDbMigration
{
	public function safeUp()
	{
		@mkdir(__DIR__.'/../../assets');
		$this->createTable("tbl_product",array(
				"id"=>"pk",
				"sku"=>"string not null",
				"name"=>"string not null",
				"description"=>"string",
				"quantity"=>"integer",
				"price"=>"double",
				"image"=>"string",
				"date_created"=>"datetime",
				"date_updated"=>"datetime",
			));
	}
	public function safeDown()
	{
		@rmdir('../../assets');
		$this->dropTable("tbl_product");
	}
}