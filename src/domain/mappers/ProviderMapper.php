<?php

namespace yii2bundle\qiwi\domain\mappers;

use yii\helpers\Inflector;

class ProviderMapper extends BaseQiwiMapper {
	
	public function map() {
		return [
			/*'id' => 'authInfo.personId',
			'country_code' => 'userInfo.language',
			'default_currency_id' => 'userInfo.defaultPayCurrency',
			'first_txn_id' => 'userInfo.firstTxnId',*/
		];
	}
	
}
