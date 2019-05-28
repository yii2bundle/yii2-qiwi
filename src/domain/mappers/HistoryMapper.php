<?php

namespace yii2bundle\qiwi\domain\mappers;

use yii\helpers\Inflector;

class HistoryMapper extends BaseQiwiMapper {
	
	public function map() {
		return [
			'sum' => 'sum.amount',
			'commission' => 'commission.amount',
			'total' => 'total.amount',
			'currency_id' => 'total.currency',
			'created_at' => 'date',
		];
	}
	
}
