<?php

namespace yii2bundle\qiwi\domain\services;

use yii2bundle\qiwi\domain\interfaces\services\HistoryInterface;
use yii2rails\domain\services\base\BaseActiveService;

/**
 * Class HistoryService
 * 
 * @package yii2bundle\qiwi\domain\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\HistoryInterface $repository
 */
class HistoryService extends BaseActiveService implements HistoryInterface {

}
