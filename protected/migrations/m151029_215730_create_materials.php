<?php

class m151029_215730_create_materials extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_materials",array(
				"id"=>"pk",
				"name"=>"string not null",
				"sku"=>"string not null",
				"description"=>"string",
				"image"=>"string",
				"quantity"=>"integer",
				"last_update"=>"datetime",
			));		
	}

	public function safeDown()
	{
		$this->dropTable("tbl_materials");
	}
}