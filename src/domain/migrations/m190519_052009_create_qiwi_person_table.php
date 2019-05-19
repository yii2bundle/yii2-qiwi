<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
 * Class m190519_052009_create_qiwi_person_table
 * 
 * @package 
 */
class m190519_052009_create_qiwi_person_table extends Migration {

	public $table = 'qiwi_person';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->string()->notNull(),
			'token' => $this->string(),
			'country_code' => $this->string()->notNull(),
			'default_currency_id' => $this->integer()->notNull(),
			'first_txn_id' => $this->string()->notNull(),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['id']);
		$this->myAddForeignKey(
			'country_code',
			'qiwi_country',
			'code',
			'CASCADE',
			'CASCADE'
		);
		$this->myAddForeignKey(
			'default_currency_id',
			'geo_currency',
			'id',
			'CASCADE',
			'CASCADE'
		);
	}

}