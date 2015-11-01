<?php

class m151029_215716_create_customer_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_customer",array(
				"id"=>"pk",
				"title"=>"string not null",
				"firstname"=>"string not null",
				"middlename"=>"string not null",
				"lastname"=>"string not null",
				"contactNumber"=>"string not null",
				"address"=>"string not null",
				"date_created"=>"datetime",
				"date_updated"=>"datetime",
			));
	}
	public function safeDown()
	{
		$this->dropTable("tbl_customer");
	}

}