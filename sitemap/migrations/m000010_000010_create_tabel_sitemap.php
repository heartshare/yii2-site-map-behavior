<?php

use \yii\db\mysql\Schema;

class m000010_000010_create_tabel_sitemap extends \yii\db\Migration
{
	public $tableName = '{{%site_map}}';

	public function safeUp()
	{
		$this->createTable(
			$this->tableName,
			[
				'id' => 'INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
				//
				'model_name' => Schema::TYPE_STRING . ' NOT NULL',
				'model_id' => 'INT UNSIGNED NOT NULL',
				//
				'lang_id' => Schema::TYPE_STRING . ' NULL',
				'label' => Schema::TYPE_STRING . ' NULL',
				'route' => Schema::TYPE_TEXT . ' NULL',
				'params' => Schema::TYPE_TEXT . ' NULL',
				'changefreq' => Schema::TYPE_INTEGER . ' NULL',
				'priority' => Schema::TYPE_STRING . ' NULL',
				//
				'created' => Schema::TYPE_INTEGER . ' NULL DEFAULT 0',
				'updated' => Schema::TYPE_INTEGER . ' NULL DEFAULT 0',
			],
			'ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci'
		);
	}

	public function safeDown()
	{
		$this->dropTable($this->tableName);
	}
}
