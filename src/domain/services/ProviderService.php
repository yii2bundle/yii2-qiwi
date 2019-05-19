<?php

namespace yii2bundle\qiwi\domain\services;

use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\domain\helpers\factory\RepositoryFactoryHelper;
use yii2bundle\qiwi\domain\entities\CategoryEntity;
use yii2bundle\qiwi\domain\entities\ProviderEntity;
use yii2bundle\qiwi\domain\interfaces\services\ProviderInterface;
use yii2rails\domain\services\base\BaseActiveService;
use yii2bundle\qiwi\domain\mappers\ProviderMapper;

/**
 * Class ProviderService
 * 
 * @package yii2bundle\qiwi\domain\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\ProviderInterface $repository
 */
class ProviderService extends BaseActiveService implements ProviderInterface {
	
	public function updateAllCahceByCategoryId($categoryId) {
		$categoryEntity = \App::$domain->qiwi->category->oneById($categoryId);
		$providerApiRepository = RepositoryFactoryHelper::createObject('provider', 'api', \App::$domain->qiwi);
		/** @var ProviderEntity[] $collection */
		$collection = $providerApiRepository->allByCategory($categoryEntity);
		foreach($collection as $providerEntity) {
			$this->insertEntity($providerEntity);
		}
		return $collection;
	}
	
	public function insertEntity(ProviderEntity $providerEntity) {
		try {
			\App::$domain->qiwi->provider->repository->insert($providerEntity);
		} catch(UnprocessableEntityHttpException $e) {
			\App::$domain->qiwi->provider->repository->update($providerEntity);
		}
	}
	
}
