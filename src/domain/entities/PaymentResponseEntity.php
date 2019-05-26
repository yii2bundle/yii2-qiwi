<?php

namespace yii2bundle\qiwi\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class PaymentResponseEntity
 * 
 * @package yii2bundle\qiwi\domain\entities
 * 
 * @property $id
 * @property $terms
 * @property $fields
 * @property $sum
 * @property $transaction
 * @property $source
 */
class PaymentResponseEntity extends BaseEntity {

	protected $id;
	protected $terms;
	protected $fields;
	protected $sum;
	protected $transaction;
	protected $source;

	public function fieldType()
    {
        return [
            'id' => 'string',
            'terms' => 'integer',
            'fields' => 'array',
            'sum' => 'array',
            'transaction' => 'array',
            'source' => 'string',
        ];
    }

}
