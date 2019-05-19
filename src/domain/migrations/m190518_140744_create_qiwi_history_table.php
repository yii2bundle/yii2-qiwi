<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
 * Class m190518_140744_create_public.qiwi_history_table
 * 
 * @package 
 */
class m190518_140744_create_qiwi_history_table extends Migration {

	public $table = 'qiwi_history';
	public $tableComment = 'Список платежей';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'trm_txn_id' => $this->string()->notNull()->comment('Клиентский ID транзакции'),
			'txn_id' => $this->string()->notNull()->comment('ID транзакции в процессинге QIWI Wallet'),
			'person_id' => $this->string()->notNull()->comment('Номер кошелька'),
			'account' => $this->string()->notNull()->comment('Для платежей - номер счета получателя. Для пополнений - номер отправителя, терминала или название агента пополнения кошелька'),
			'type' => $this->string()->notNull()->comment('Тип платежа. Возможные значения: IN - пополнение, OUT - платеж, QIWI_CARD - платеж с карт QIWI (QVC, QVP).'),
			'error_code' => $this->integer()->notNull()->comment('Код ошибки платежа'),
			'error_text' => $this->string()->comment('Описание ошибки'),
			'sum' => $this->float()->notNull()->comment('Сумма платежа'),
			'commission' => $this->float()->notNull()->comment('Комиссия платежа'),
			'total' => $this->float()->notNull()->comment('Фактическая сумме платежа или пополнения'),
			'currency_id' => $this->integer()->notNull()->comment('Валюта'),
			'comment' => $this->string()->comment('Комментарий к платежу'),
			'provider_id' => $this->integer()->notNull()->comment('ID провайдера'),
			'status' => $this->string()->notNull()->comment('Статус платежа. Возможные значения: WAITING - платеж проводится, SUCCESS - успешный платеж, ERROR - ошибка платежа.'),
			'created_at' => $this->timestamp()->defaultValue(null)->notNull()->comment('Дата/время платежа'),
		];
	}

	public function afterCreate()
	{
		//$this->myCreateIndexUnique(['txn_id']);
		$this->myAddForeignKey(
			'person_id',
			'qiwi_account',
			'phone',
			'CASCADE',
			'CASCADE'
		);
		$this->myAddForeignKey(
			'currency_id',
			'geo_currency',
			'id',
			'CASCADE',
			'CASCADE'
		);
		$this->myAddForeignKey(
			'provider_id',
			'qiwi_provider',
			'id',
			'CASCADE',
			'CASCADE'
		);
	}

}