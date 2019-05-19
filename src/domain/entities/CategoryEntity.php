<?php

namespace yii2bundle\qiwi\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class CategoryEntity
 * 
 * @package yii2bundle\qiwi\domain\entities
 * 
 * @property $id
 * @property $country_code
 * @property $name
 * @property $alias
 * @property $logo_url
 */
class CategoryEntity extends BaseEntity {

	protected $id;
	protected $country_code;
	protected $name;
	protected $alias;
	protected $logo_url;

}
