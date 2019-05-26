<?php

namespace yii2bundle\qiwi\domain\services;

use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use yii2rails\app\domain\helpers\EnvService;
use yii2rails\domain\helpers\factory\RepositoryFactoryHelper;
use yii2bundle\qiwi\domain\entities\PersonEntity;
use yii2bundle\qiwi\domain\interfaces\services\PersonInterface;
use yii2rails\domain\services\base\BaseActiveService;
use yii2bundle\qiwi\domain\helpers\Qiwi;

/**
 * Class PersonService
 * 
 * @package yii2bundle\qiwi\domain\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\PersonInterface $repository
 */
class PersonService extends BaseActiveService implements PersonInterface {

	/** @var Qiwi */
	private $qiwiInstance = null;
	private $personId = null;
	private $personEntity = null;
	
	private function auth($id, $token) {
		$this->qiwiInstance = new Qiwi($id, $token);
		$this->personId = $id;
	}
	
	public function getPerson() : PersonEntity {
		if(empty($this->personEntity)) {
			try {
				$this->personEntity = $this->repository->oneById($this->personId);
			} catch(NotFoundHttpException $e) {
				$this->personEntity = $this->cacheEntity();
				$this->insertEntity($this->personEntity);
			}
		}
		return $this->personEntity;
	}
	
	public function getQiwiInstance() : Qiwi {
		if(!$this->qiwiInstance instanceof Qiwi) {
            $accessConfig = EnvService::get('qiwi');
            if(empty($accessConfig)) {
                throw new InvalidConfigException('Payment system "Qiwi" not configured!');
            }
            $this->auth($accessConfig['login'], $accessConfig['token']);
			//throw new UnauthorizedHttpException('Qiwi person unauthorized!');
		}
		return $this->qiwiInstance;
	}
	
	public function cacheEntity() {
		$personApiRepository = RepositoryFactoryHelper::createObject('person', 'api', \App::$domain->qiwi);
		$personEntity = $personApiRepository->auth();
		return $personEntity;
	}
	
	public function insertEntity(PersonEntity $personEntity) {
		try {
			\App::$domain->qiwi->person->repository->insert($personEntity);
		} catch(UnprocessableEntityHttpException $e) {}
	}
	
}
