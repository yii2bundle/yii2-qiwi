<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
 * Class m190518_175641_create_qiwi.country_table
 * 
 * @package 
 */
class m190515_175641_create_qiwi_country_table extends Migration {

	public $table = 'qiwi_country';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'code' => $this->string()->notNull(),
			'name' => $this->string()->notNull(),
			'mask' => $this->string()->notNull(),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['code']);
	}

}
