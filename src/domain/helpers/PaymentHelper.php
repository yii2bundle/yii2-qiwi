<?php

namespace yii2bundle\qiwi\domain\helpers;

use yii2bundle\qiwi\domain\entities\PaymentEntity;
use yii2mod\helpers\ArrayHelper;

class PaymentHelper {

	public static function paymentEntotyToParams(PaymentEntity $paymentEntity) {
        $array = [
            'id' => $paymentEntity->id,
            'sum' => [
                'amount' => $paymentEntity->amount,
                'currency' => "{$paymentEntity->currency_id}",
            ],
            'paymentMethod' => [
                'type' => 'Account',
                'accountId' => "{$paymentEntity->currency_id}",
            ],
            'fields' => $paymentEntity->fields,
        ];
        return $array;
	}

}
