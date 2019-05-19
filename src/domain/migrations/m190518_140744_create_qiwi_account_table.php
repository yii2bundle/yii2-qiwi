<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
 * Class m190518_140744_create_public.qiwi_account_table
 * 
 * @package 
 */
class m190518_140744_create_qiwi_account_table extends Migration {

	public $table = 'qiwi_account';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'phone' => $this->string()->notNull(),
			'token' => $this->string()->notNull(),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['phone']);
	}

}