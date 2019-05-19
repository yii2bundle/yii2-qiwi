<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
 * Class m190518_172759_create_qiwi.category_table
 * 
 * @package 
 */
class m190516_172759_create_qiwi_category_table extends Migration {

	public $table = 'qiwi_category';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->integer()->comment('ID'),
			'country_code' => $this->string()->notNull(),
			'alias' => $this->string()->notNull(),
			'name' => $this->string()->notNull(),
			'logo_url' => $this->string()->notNull(),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['id']);
		$this->myCreateIndexUnique(['country_code', 'alias']);
		$this->myAddForeignKey(
			'country_code',
			'qiwi_country',
			'code',
			'CASCADE',
			'CASCADE'
		);
	}

}