<?php

namespace yii2bundle\qiwi\domain\repositories\api;

use yii2rails\domain\BaseEntity;
use yii2rails\domain\data\Query;
use yii2rails\extension\activeRecord\repositories\base\BaseActiveArRepository;
use yii2bundle\qiwi\domain\entities\PersonEntity;
use yii2bundle\qiwi\domain\interfaces\repositories\PersonInterface;
use yii2rails\domain\repositories\BaseRepository;
use yii2bundle\qiwi\domain\mappers\CategoryMapper;
use yii2bundle\qiwi\domain\mappers\PersonMapper;

/**
 * Class PersonRepository
 *
 * @package yii2bundle\qiwi\domain\repositories\api
 *
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 */
class PersonRepository extends BaseRepository /*implements PersonInterface*/ {
	
	protected $schemaClass = true;
	
	public function auth() : PersonEntity {
		$personData = \App::$domain->qiwi->person->getQiwiInstance()->getAccount();
		$personMapper = new PersonMapper;
		$decoded = $personMapper->decode($personData);
		$personEntity = new PersonEntity;
		$personEntity->load($decoded);
		return $personEntity;
	}
	
}
