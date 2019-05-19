<?php

namespace yii2bundle\qiwi\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class PersonEntity
 * 
 * @package yii2bundle\qiwi\domain\entities
 * 
 * @property $id
 * @property $token
 * @property $country_code
 * @property $default_currency_id
 * @property $first_txn_id
 */
class PersonEntity extends BaseEntity {

	protected $id;
	protected $token;
	protected $country_code;
	protected $default_currency_id;
	protected $first_txn_id;

}
