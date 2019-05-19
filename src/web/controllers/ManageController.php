<?php

namespace yii2bundle\qiwi\web\controllers;

use yii\web\Controller;
use yii2rails\domain\data\Query;
use yii2lab\notify\domain\entities\SmsEntity;
use yii2rails\domain\values\TimeValue;
use yii2rails\extension\qiwi\entities\CategoryEntity;
use yii2rails\extension\qiwi\entities\HistoryEntity;
use yii2rails\extension\qiwi\entities\ProviderEntity;
use yii2rails\extension\qiwi\enums\OperationEnum;
use yii2rails\extension\qiwi\helpers\Qiwi;
use yii2rails\extension\qiwi\mappers\CategoryMapper;

class ManageController extends Controller
{
	
	public function actionIndex()
	{
		
		/*$mapper = new CategoryMapper;
		$data1 = $mapper->decode([
			'type' => 'CATEGORY',
			'id' => 34,
			'name' => 'Переводы между кошельками',
			'logoUrl' => 'https://static.qiwi.com/img/providers/v2/categories/wallet.svg',
			'alias' => 'wallet-transfer',
		]);
		$data2 = $mapper->encode($data1);
		//d($data1);
		d($data2);*/
		
		// https://github.com/Shnapik/Qiwi-Api-Class-PHP
		//$qiwi = new Qiwi('77783177384', 'b233d83635d03c870ef492e72bd46009');
		
		\App::$domain->qiwi->person->auth('77783177384', 'b233d83635d03c870ef492e72bd46009');
		
		/*$categories = \App::$domain->qiwi->provider->updateAllCahceByCategoryId(26);
		d($categories);*/
		
		$categories = \App::$domain->qiwi->category->updateAllCahce();
		d($categories);
		
		
		
		$startDateTime = new \DateTime('-88 days');
		$startDate = $startDateTime->format(\DateTime::ATOM);
		
		$endDateTime = new \DateTime('+1 days');
		$endDate = $endDateTime->format(\DateTime::ATOM);
		
		$params = [
			'startDate' => $startDate,
			'endDate' => $endDate,
			//'operation' => OperationEnum::IN,
			'rows' => '50',
		];
		
		$historyArray = $qiwi->getPaymentsHistory($params);
		//d($historyArray);
		$collection = [];
		foreach($historyArray['data'] as $historyItem) {
			
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
			$collection[] = $hitoryEntity;
			
			$providerEntity = new ProviderEntity;
			$providerEntity->id = $historyItem['provider']['id'];
			$providerEntity->short_name = $historyItem['provider']['shortName'];
			$providerEntity->long_name = $historyItem['provider']['longName'];
			$providerEntity->logo_url = $historyItem['provider']['logoUrl'];
			$providerEntity->description = $historyItem['provider']['description'];
			$providerEntity->keys = $historyItem['provider']['keys'];
			$providerEntity->site_url = $historyItem['provider']['siteUrl'];
			$providerEntity->extras = $historyItem['provider']['extras'];
			
			\App::$domain->qiwi->provider->repository->insert($providerEntity);
			
			$hitoryEntity->provider_id = $providerEntity->id;
			\App::$domain->qiwi->history->repository->insert($hitoryEntity);
		}
		
		d($collection);
		
		
		/*
,'' => 'SUCCESS',
,'' => 'IN',
,'trmTxnId' => '24303576745008',
,'account' => '10386251',
,'sum' => [
		,,'amount' => '980',
		,,'currency' => '398',
		,],
,'commission' => [
		,,'amount' => '0',
		,,'currency' => '398',
		,],
,'total' => [
		,,'amount' => '980',
		,,'currency' => '398',
		,],
,'comment' => '',*/
		
		d($historyArray['data']);
		//prr(\App::$domain->file->person->all(),1,1);
		/*$sms = new SmsEntity;
		$sms->address = '777712345678';
		$sms->content = 'wertyu';
		//\App::$domain->notify->sms->sendEntity($sms);
		//\App::$domain->notify->sms->directSendEntity($sms);*/
		return $this->render('index');
	}

}
