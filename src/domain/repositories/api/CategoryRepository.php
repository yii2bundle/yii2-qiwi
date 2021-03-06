<?php

namespace yii2bundle\qiwi\domain\repositories\api;

use yii2rails\domain\BaseEntity;
use yii2rails\domain\data\Query;
use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\entities\CategoryEntity;
use yii2bundle\qiwi\domain\interfaces\repositories\CategoryInterface;
use yii2rails\domain\repositories\BaseRepository;
use yii2bundle\qiwi\domain\mappers\CategoryMapper;

/**
 * Class CategoryRepository
 *
 * @package yii2bundle\qiwi\domain\repositories\api
 *
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class CategoryRepository extends BaseRepository implements CategoryInterface {
	
	protected $schemaClass = true;
	
	public function all(Query $query = null) {
        $personEntity = \App::$domain->qiwi->person->getPerson();
		$catalogs = $this->getAllItems();
		$categoryMapper = new CategoryMapper;
		$collection = [];
		foreach($catalogs as $categoryArray) {
			$categoryEntity = new CategoryEntity;
			$decoded = $categoryMapper->decode($categoryArray);
			$categoryEntity->load($decoded);
			$categoryEntity->country_code = $personEntity->country_code;
			$collection[] = $categoryEntity;
		}
		return $collection;
	}
	
	private function getAllItems() {
		$qiwi = \App::$domain->qiwi->person->getQiwiInstance();
		$personEntity = \App::$domain->qiwi->person->getPerson();
		$uri = 'providers-catalog/v2/catalogs/' . $personEntity->country_code;
		$categories = $qiwi->getCollection($uri, ['limit' => 100]);
		return $categories;
	}
	
	public function oneById($id, Query $query = null) {
	
	}
	
	public function count(Query $query = null) {
		// TODO: Implement count() method.
	}
	
	public function insert(BaseEntity $entity) {
		// TODO: Implement insert() method.
	}
	
	public function update(BaseEntity $entity) {
		// TODO: Implement update() method.
	}
	
	public function delete(BaseEntity $entity) {
		// TODO: Implement delete() method.
	}
	
	public function truncate() {
		// TODO: Implement truncate() method.
	}
	
}
