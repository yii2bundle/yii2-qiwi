<?php

namespace yii2bundle\qiwi\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class HistoryEntity
 * 
 * @package yii2bundle\qiwi\domain\entities
 * 
 * @property $txn_id
 * @property $trm_txn_id
 * @property $person_id
 * @property $account
 * @property $type
 * @property $error_code
 * @property $error_text
 * @property $sum
 * @property $commission
 * @property $total
 * @property $currency_id
 * @property $comment
 * @property $provider_id
 * @property $status
 * @property $created_at
 */
class HistoryEntity extends BaseEntity {

	protected $txn_id;
	protected $trm_txn_id;
	protected $person_id;
	protected $account;
	protected $type;
	protected $error_code;
	protected $error_text;
	protected $sum;
	protected $commission;
	protected $total;
	protected $currency_id;
	protected $comment;
	protected $provider_id;
	protected $status;
	protected $created_at;

}
