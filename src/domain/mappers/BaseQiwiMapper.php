<?php

namespace yii2bundle\qiwi\domain\mappers;

use yii\helpers\Inflector;
use yii2bundle\qiwi\domain\entities\CategoryEntity;

class BaseQiwiMapper extends BaseMapper {
	
	public function decodeName($name) {
		$name = parent::decodeName($name);
		$name = Inflector::underscore($name);
		return $name;
	}
	
	public function encodeName($name) {
		$name = parent::encodeName($name);
		$name = Inflector::id2camel($name, '_');
		$name = lcfirst($name);
		return $name;
	}
	
}
