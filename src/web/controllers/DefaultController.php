<?php

namespace yii2bundle\qiwi\web\controllers;

use yii\web\Controller;
use yii2bundle\qiwi\domain\entities\PaymentEntity;
use yii2rails\domain\data\Query;

class DefaultController extends Controller
{
	
	public function actionIndex()
	{

        $response = \App::$domain->qiwi->history->oneById('15635958311');
        d($response);

        //prr($data);
       /* $paymentEntity = new PaymentEntity;
        $paymentEntity->provider_id = 20494;
        $paymentEntity->amount = 1;
        $paymentEntity->fields = [
            'account' => '7783177384',
        ];
        //$paymentEntity->id = ;

		$dd = \App::$domain->qiwi->payment->pay($paymentEntity);
        d($dd);*/

		$query = new Query;
		$query->limit(100);
		$categoryDataProvider = \App::$domain->qiwi->category->getDataProvider($query);
		return $this->render('index', [
			'categoryDataProvider' => $categoryDataProvider,
		]);
	}

}
