<?php

namespace yii2bundle\qiwi\domain\repositories\ar;

use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\interfaces\repositories\HistoryInterface;

/**
 * Class HistoryRepository
 * 
 * @package yii2bundle\qiwi\domain\repositories\ar
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class HistoryRepository extends BaseActiveArRepository implements HistoryInterface {

	protected $schemaClass = true;
	
	public function tableName() {
		return 'qiwi_history';
	}
	
}
