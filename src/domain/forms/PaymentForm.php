<?php

namespace yii2bundle\qiwi\domain\forms;

use Yii;
use yii\base\Model;

class PaymentForm extends Model {
	
	public $amount;
	
	public function attributeLabels() {
		return [
			'amount' => Yii::t('qiwi/provider', 'amount'),
		];
	}
}
