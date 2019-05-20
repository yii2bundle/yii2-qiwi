<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

class m190517_163558_create_qiwi_provider_table extends Migration {

	public $table = 'qiwi_provider';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->integer()->notNull()->comment('ID провайдера в QIWI Wallet'),
			'category_id' => $this->integer()->notNull(),
			'short_name' => $this->string()->notNull()->comment('краткое наименование провайдера'),
			'long_name' => $this->string()->comment('развернутое наименование провайдера'),
			'logo_url' => $this->string()->comment('ссылка на логотип провайдера'),
			'description' => $this->string()->comment('описание провайдера (HTML)'),
			'keys' => $this->text()->comment('ключевых слов'),
			'site_url' => $this->string()->comment('сайт провайдера'),
			'extras' => $this->json()->comment('Служебная информация'),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['id']);
		//$this->myCreateIndexUnique(['country_code', 'short_name']);
		/*$this->myAddForeignKey(
			'country_code',
			'qiwi_country',
			'code',
			'CASCADE',
			'CASCADE'
		);*/
		$this->myAddForeignKey(
			'category_id',
			'qiwi_category',
			'id',
			'CASCADE',
			'CASCADE'
		);
	}

}