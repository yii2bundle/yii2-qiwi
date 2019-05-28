<?php

namespace yii2bundle\qiwi\domain\services;

use yii\base\InvalidArgumentException;
use yii\web\NotFoundHttpException;
use yii2bundle\qiwi\domain\entities\HistoryEntity;
use yii2bundle\qiwi\domain\interfaces\services\HistoryInterface;
use yii2bundle\qiwi\domain\mappers\BaseQiwiMapper;
use yii2bundle\qiwi\domain\mappers\HistoryMapper;
use yii2rails\domain\data\Query;
use yii2rails\domain\services\base\BaseActiveService;
use yii2rails\domain\services\base\BaseService;

/**
 * Class HistoryService
 * 
 * @package yii2bundle\qiwi\domain\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\HistoryInterface $repository
 */
class HistoryService extends BaseService /*implements HistoryInterface*/ {

    public function all($startDate, $endDate) {
        $params = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'rows' => 50,
        ];
        $historyArray = \App::$domain->qiwi->person->getQiwiInstance()->getPaymentsHistory($params);
        $collection = [];
        foreach ($historyArray['data'] as $historyItem) {
            $hitoryEntity = $this->mapEntity($historyItem);
            $collection[] = $hitoryEntity;
        }
        return $collection;
    }

    public function oneById($txnId, Query $query = null) {
        if(empty($txnId)) {
            throw new InvalidArgumentException('Empty "txnId"');
        }

        $historyItem = \App::$domain->qiwi->person->getQiwiInstance()->getTxn($txnId);
        if(empty($historyItem['txnId'])) {
            throw new NotFoundHttpException('Operation not found!');
        }
        $hitoryEntity = $this->mapEntity($historyItem);
        return $hitoryEntity;
    }

    private function mapEntity($historyItem) : HistoryEntity {
        $mapper = new HistoryMapper;
        $decoded = $mapper->decode($historyItem);
        $hitoryEntity = new HistoryEntity($decoded);
        $hitoryEntity->sum = $historyItem['sum']['amount'];
        $hitoryEntity->commission = $historyItem['commission']['amount'];
        $hitoryEntity->total = $historyItem['total']['amount'];
        $hitoryEntity->currency_id = $historyItem['total']['currency'];
        $hitoryEntity->created_at = $historyItem['date'];
        return $hitoryEntity;
    }

}
