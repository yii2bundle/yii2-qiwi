<?php

namespace yii2bundle\qiwi\domain\services;

use yii\helpers\ArrayHelper;
use yii2rails\domain\data\Query;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\domain\helpers\factory\RepositoryFactoryHelper;
use yii2bundle\qiwi\domain\entities\CategoryEntity;
use yii2bundle\qiwi\domain\interfaces\services\CategoryInterface;
use yii2rails\domain\services\base\BaseActiveService;
use yii2bundle\qiwi\domain\helpers\Qiwi;
use yii2bundle\qiwi\domain\mappers\CategoryMapper;

/**
 * Class CategoryService
 * 
 * @package yii2bundle\qiwi\domain\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\CategoryInterface $repository
 */
class CategoryService extends BaseActiveService implements CategoryInterface {

	public function updateAllCahce() {
		$categoryApiRepository = RepositoryFactoryHelper::createObject('category', 'api', \App::$domain->qiwi);
		/** @var CategoryEntity[] $collection */
		$collection = $categoryApiRepository->all();
		foreach($collection as $categoryEntity) {
			$this->insertEntity($categoryEntity);
			\App::$domain->qiwi->provider->updateAllCahceByCategoryId($categoryEntity->id);
		}
		return $collection;
	}
	
	public function insertEntity(CategoryEntity $categoryEntity) {
		try {
			\App::$domain->qiwi->category->repository->insert($categoryEntity);
		} catch(UnprocessableEntityHttpException $e) {
			\App::$domain->qiwi->category->repository->update($categoryEntity);
		}
	}
	
}
