<?php

namespace yii2bundle\qiwi\domain\repositories\ar;

use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\interfaces\repositories\ProviderInterface;
use yii2rails\domain\repositories\BaseRepository;

/**
 * Class ProviderRepository
 * 
 * @package yii2bundle\qiwi\domain\repositories\ar
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class ProviderRepository extends BaseActiveArRepository implements ProviderInterface {

	protected $schemaClass = true;
	
	public function tableName() {
		return 'qiwi_provider';
	}
	
}
