<?php

namespace yii2bundle\qiwi\domain\services;

use yii2bundle\qiwi\domain\entities\HistoryEntity;
use yii2bundle\qiwi\domain\interfaces\services\HistoryInterface;
use yii2rails\domain\data\Query;
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

    public function oneById($txnId, Query $query = null) {
        \App::$domain->qiwi->person->auth('77783177384', 'b233d83635d03c870ef492e72bd46009');
        $historyItem = \App::$domain->qiwi->person->getQiwiInstance()->getTxn($txnId);

        $hitoryEntity = new HistoryEntity;
        $hitoryEntity->txn_id = $historyItem['txnId'];
        $hitoryEntity->trm_txn_id = $historyItem['trmTxnId'];
        $hitoryEntity->person_id = $historyItem['personId'];
        $hitoryEntity->account = $historyItem['account'];
        $hitoryEntity->type = $historyItem['type'];
        $hitoryEntity->error_code = $historyItem['errorCode'];
        $hitoryEntity->error_text = $historyItem['error'];
        $hitoryEntity->sum = $historyItem['sum']['amount'];
        $hitoryEntity->commission = $historyItem['commission']['amount'];
        $hitoryEntity->total = $historyItem['total']['amount'];
        $hitoryEntity->currency_id = $historyItem['total']['currency'];
        $hitoryEntity->comment = $historyItem['comment'];
        $hitoryEntity->status = $historyItem['status'];
        $hitoryEntity->created_at = $historyItem['date'];

        return $hitoryEntity;
    }

}
