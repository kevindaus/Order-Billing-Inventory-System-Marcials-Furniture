<?php

class m151126_140057_create_product_requirement_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_product_requirement", array(
				"id"=>"pk",
				"product_id"=>"integer",
				"material_id"=>"integer",
				"quantity"=>"integer"
			));
		$this->addForeignKey("product_product_requirement_fk", "tbl_product_requirement", "product_id", "tbl_product", "id", "CASCADE", "CASCADE");
		$this->addForeignKey("product_requirement_materials", "tbl_product_requirement", "material_id", "tbl_materials", "id", "CASCADE", "CASCADE");
	}

	public function safeDown()
	{
		$this->dropForeignKey("product_product_requirement_fk", "tbl_product_requirement");
		$this->dropForeignKey("product_requirement_materials", "tbl_product_requirement");
		$this->dropTable("tbl_product_requirement");
	}
}