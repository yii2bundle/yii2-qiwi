<?php

namespace yii2bundle\qiwi\domain\interfaces\services;

use yii2rails\domain\interfaces\services\CrudInterface;

/**
 * Interface ProviderInterface
 * 
 * @package yii2bundle\qiwi\domain\interfaces\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\ProviderInterface $repository
 */
interface ProviderInterface extends CrudInterface {

}
