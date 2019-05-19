<?php

namespace yii2bundle\qiwi\domain\interfaces\services;

use yii2rails\domain\interfaces\services\CrudInterface;
use yii2bundle\qiwi\domain\entities\PersonEntity;
use yii2bundle\qiwi\domain\helpers\Qiwi;

/**
 * Interface PersonInterface
 * 
 * @package yii2bundle\qiwi\domain\interfaces\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\PersonInterface $repository
 */
interface PersonInterface extends CrudInterface {
	
	public function auth($id, $token);
	public function getPerson() : PersonEntity;
	public function getQiwiInstance() : Qiwi;
	
}
