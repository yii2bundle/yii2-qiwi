<?php

namespace yii2bundle\qiwi\domain\mappers;

use yii2mod\helpers\ArrayHelper;
use yii2bundle\qiwi\domain\entities\CategoryEntity;

class BaseMapper {
	
	public function map() {
		return [];
	}
	
	public function decodeName($name) {
		$map = $this->map();
		if(array_key_exists($name, $map)) {
			$name = $map[$name];
		}
		return $name;
	}
	
	public function encodeName($name) {
		$map = $this->map();
		$map = array_flip($map);
		if(array_key_exists($name, $map)) {
			$name = $map[$name];
		}
		return $name;
	}
	
	public function encode($decoded, $only = null) {
		$encoded = [];
		foreach($decoded as $key => $value) {
			$key = $this->encodeName($key);
			ArrayHelper::setValue($encoded, $key, $value);
		}
		if($only) {
			$encoded = ArrayHelper::filter($encoded, $only);
		}
		return $encoded;
	}
	
	public function decode($encoded, $only = null) {
		$decoded = [];
		$map = $this->map();
		foreach($map as $key => $alias) {
			$value = ArrayHelper::getValue($encoded, $alias);
			ArrayHelper::setValue($decoded, $key, $value);
		}
		foreach($encoded as $key => $value) {
			$key = $this->decodeName($key);
			ArrayHelper::setValue($decoded, $key, $value);
		}
		if($only) {
			$decoded = ArrayHelper::filter($decoded, $only);
		}
		return $decoded;
	}

}
