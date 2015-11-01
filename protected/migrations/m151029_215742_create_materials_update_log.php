<?php

class m151029_215742_create_materials_update_log extends CDbMigration
{

	public function safeUp()
	{
		$this->createTable("tbl_materials_update_log",array(
				"id"=>"pk",
				"material_id"=>"integer",
				"old_quantity"=>"integer",
				"new_quantity"=>"integer",
				"date_created"=>"datetime",
			));		
		$this->addForeignKey("materials_update_log_fk", "tbl_materials_update_log", "material_id", "tbl_materials", "id", "CASCADE", "CASCADE");
	}

	public function safeDown()
	{
		$this->dropTable("tbl_materials_update_log");
	}

}