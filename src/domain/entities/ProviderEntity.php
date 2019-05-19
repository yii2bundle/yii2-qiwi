<?php

namespace yii2bundle\qiwi\domain\entities;

use yii2rails\domain\BaseEntity;

/**
 * Class ProviderEntity
 * 
 * @package yii2bundle\qiwi\domain\entities
 * 
 * @property $id
 * @property $category_id
 * @property $short_name
 * @property $long_name
 * @property $logo_url
 * @property $description
 * @property $keys
 * @property $site_url
 * @property $extras
 */
class ProviderEntity extends BaseEntity {

	protected $id;
	protected $category_id;
	protected $short_name;
	protected $long_name;
	protected $logo_url;
	protected $description;
	protected $keys;
	protected $site_url;
	protected $extras;

}
