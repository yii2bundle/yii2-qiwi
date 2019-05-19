<?php

namespace yii2bundle\qiwi\domain\repositories\ar;

use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\interfaces\repositories\CategoryInterface;
use yii2rails\domain\repositories\BaseRepository;

/**
 * Class CategoryRepository
 * 
 * @package yii2bundle\qiwi\domain\repositories\ar
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class CategoryRepository extends BaseActiveArRepository implements CategoryInterface {

	protected $schemaClass = true;
	
	public function tableName() {
		return 'qiwi_category';
	}
	
}
