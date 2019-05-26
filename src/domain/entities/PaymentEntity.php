<?php

namespace yii2bundle\qiwi\domain\entities;

use yii2rails\domain\BaseEntity;
use yii2rails\extension\common\helpers\Helper;

/**
 * Class PaymentEntity
 * 
 * @package yii2bundle\qiwi\domain\entities
 * 
 * @property $id
 * @property $amount
 * @property $currency_id
 * @property $provider_id
 * @property $fields
 */
class PaymentEntity extends BaseEntity {

	protected $id = null;
    protected $amount;
    protected $currency_id;
    protected $provider_id;
	protected $fields;

	public function rules()
    {
        return [
            [['id', 'amount', 'currency_id', 'provider_id', 'fields'], 'required'],
            [['id', 'currency_id', 'provider_id'], 'integer'],
            //['fields', 'array'],
            ['amount', 'double'],
        ];
    }

    public function getId() {
	    if($this->id == null) {
            $this->id = Helper::microtimeId();
        }
        return $this->id;
    }
}
