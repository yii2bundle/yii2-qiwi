<?php

namespace yii2bundle\qiwi\domain\repositories\ar;

use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\interfaces\repositories\PersonInterface;
use yii2rails\domain\repositories\BaseRepository;

/**
 * Class PersonRepository
 * 
 * @package yii2bundle\qiwi\domain\repositories\ar
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class PersonRepository extends BaseActiveArRepository implements PersonInterface {

	protected $schemaClass = true;
	
	public function tableName() {
		return 'qiwi_person';
	}
	
}
