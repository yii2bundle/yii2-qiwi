<?php

namespace yii2bundle\qiwi\domain\services;

use yii\helpers\ArrayHelper;
use yii2bundle\qiwi\domain\entities\PaymentEntity;
use yii2bundle\qiwi\domain\entities\PaymentResponseEntity;
use yii2bundle\qiwi\domain\helpers\PaymentHelper;
use yii2bundle\qiwi\domain\interfaces\services\PaymentInterface;
use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use yii2rails\domain\helpers\ErrorCollection;
use yii2rails\domain\services\base\BaseService;
use yii2rails\extension\common\helpers\Helper;

/**
 * Class PaymentService
 * 
 * @package yii2bundle\qiwi\domain\services
 * 
 * @property-read \yii2bundle\qiwi\domain\Domain $domain
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\PaymentInterface $repository
 */
class PaymentService extends BaseService implements PaymentInterface {

    public function pay(PaymentEntity $paymentEntity) {
        \App::$domain->qiwi->person->auth('77783177384', 'b233d83635d03c870ef492e72bd46009');
        if($paymentEntity->currency_id == null) {
            $paymentEntity->currency_id = \App::$domain->qiwi->person->getPerson()->default_currency_id;
        }
        $paymentEntity->validate();
        //d($paymentEntity);
        $params = PaymentHelper::paymentEntotyToParams($paymentEntity);
        //d($params);
        $responseData = \App::$domain->qiwi->person->getQiwiInstance()->sendMoneyToProvider($paymentEntity->provider_id, $params);

        /*$responseData = [
            'id' => $paymentEntity->id,
            'terms' => '20494',
            'fields' => $paymentEntity->fields,
            'sum' => [
                'amount' => $paymentEntity->amount,
                'currency' => $paymentEntity->currency_id,
            ],
            'transaction' => [
                'id' => '15635494441',
                'state' => [
                    'code' => 'Accepted',
                ],
            ],
            'source' => 'account_' . $paymentEntity->currency_id,
        ];*/

        $errorCode = ArrayHelper::getValue($responseData, 'code');

        if($errorCode) {
            $errorMessage = ArrayHelper::getValue($responseData, 'message');
            if($errorCode = 'QWPRC-1002') {
                $error = new ErrorCollection;
                $error->add('currency_id', $errorMessage);
                throw new UnprocessableEntityHttpException($error);
            } else {
                d($responseData);
            }
        } else {
            $paymentResponseEntity = new PaymentResponseEntity($responseData);
        }
        //d($responseData);
        return $paymentResponseEntity;
    }

}
