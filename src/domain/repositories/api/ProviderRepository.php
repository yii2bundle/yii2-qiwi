<?php

namespace yii2bundle\qiwi\domain\repositories\api;

use yii2rails\domain\BaseEntity;
use yii2rails\domain\data\Query;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\entities\CategoryEntity;
use yii2bundle\qiwi\domain\entities\ProviderEntity;
use yii2bundle\qiwi\domain\interfaces\repositories\ProviderInterface;
use yii2rails\domain\repositories\BaseRepository;
use yii2bundle\qiwi\domain\mappers\ProviderMapper;

/**
 * Class ProviderRepository
 *
 * @package yii2bundle\qiwi\domain\repositories\api
 *
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class ProviderRepository extends BaseRepository implements ProviderInterface {
	
	protected $schemaClass = true;
	
	public function oneById($id, Query $query = null) {
	
	}
	
	public function allByCategory(CategoryEntity $categoryEntity, Query $query = null) {
		$qiwi = \App::$domain->qiwi->person->getQiwiInstance();
		$personEntity = \App::$domain->qiwi->person->getPerson();
		$providers = $qiwi->getCatalog($personEntity->country_code, $categoryEntity->alias);
		$ProviderMapper = new ProviderMapper;
		$collection = [];
		foreach($providers['items'] as $ProviderArray) {
			$providerEntity = new ProviderEntity;
			$decoded = $ProviderMapper->decode($ProviderArray);
			$providerEntity->load($decoded);
			$providerEntity->category_id = $categoryEntity->id;
			$collection[] = $providerEntity;
			//$this->insertEntity($providerEntity);
		}
		return $collection;
	}
	
	public function all(Query $query = null) {
	
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
