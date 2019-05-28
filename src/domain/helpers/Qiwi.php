<?php

namespace yii2bundle\qiwi\domain\helpers;

use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii2lab\rest\domain\entities\RequestEntity;
use yii2lab\rest\domain\helpers\RestHelper;
use yii2mod\helpers\ArrayHelper;

class Qiwi {
	
	private $_phone;
	private $_token;
	private $_url;
	
	function __construct($phone, $token) {
		$this->_phone = $phone;
		$this->_token = $token;
		$this->_url = 'https://edge.qiwi.com/';
	}

    private function __sendRequest($method, array $content = [], $post = false) {
        $requestEntity = new RequestEntity;
        if($post) {
            $requestEntity->uri = $this->_url . $method;
            $requestEntity->data = json_encode($content);
        } else {
            $requestEntity->uri = $this->_url . $method . '/?' . http_build_query($content);
            $requestEntity->data = $content;
        }
        $requestEntity->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->_token,
            'Host' => 'edge.qiwi.com',
        ];

        $responseEntity = RestHelper::sendRequest($requestEntity);
        $body = $responseEntity->data;

        //d($body);

        if(!empty($body['traceId'])) {
            //d($body);
            $this->showError($body);
        }

        return $body;
    }

	private function sendRequest($method, array $content = [], $post = false) {
		$ch = curl_init();
		if($post) {
			curl_setopt($ch, CURLOPT_URL, $this->_url . $method);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
		} else {
			curl_setopt($ch, CURLOPT_URL, $this->_url . $method . '/?' . http_build_query($content));
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->_token,
			'Host: edge.qiwi.com',
		]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
        $errorNumber = curl_errno($ch);
        $errorMessage = curl_error($ch);
		curl_close($ch);
		$body = json_decode($result, 1);

        //d($body);

		if(!empty($body['traceId'])) {
            $this->showError($body);
        }

		return $body;
	}

	private function showError($body) {
	    /*
        'serviceName' => 'payment-history',
        'errorCode' => 'payment.history.not.found',
        'description' => 'Payment history not found',
        'userMessage' => 'Payment history not found',
        'dateTime' => '2019-05-27T08:13:03.164+03:00',
        'traceId' => '19f0ec88abdf4c28',
	    */
        if(mb_strpos($body['errorCode'], 'not.found')) {
            throw new NotFoundHttpException($body['userMessage']);
        }
        //d($body);
        throw new ServerErrorHttpException(json_encode($body, JSON_PRETTY_PRINT));
    }

	private function getCollectionPart($uri, Array $params = []) {
		$collection = $this->sendRequest($uri, $params);
		$items = ArrayHelper::getValue($collection, 'items', []);
		return $items;
	}
	
	public function getCollection($uri, Array $params = []) {
		$collection = [];
		$limit = ArrayHelper::getValue($params, 'limit', 20);
		if($limit > 100) {
			$params['limit'] = 100;
			do {
				$items = $this->getCollectionPart($uri, $params);
				$lastItem = ArrayHelper::last($items);
				/*if($params['lastItemId'] == $lastItem['id']) {
					break;
				}*/
				$params['lastItemId'] = $lastItem['id'];
				$collection = array_merge($collection, $items);
			} while(count($items));
		} else {
			$collection = $this->getCollectionPart($uri, $params);
		}
		return $collection;
	}
	
	public function getCatalog($country, $category, Array $params = []) {
		return $this->sendRequest('providers-catalog/v2/catalogs/'.$country.'/categories/' . $category, $params);
	}
	
	public function getCatalogs($country, Array $params = []) {
		return $this->sendRequest('providers-catalog/v2/catalogs/' . $country, $params);
	}
	
	public function getAccount(Array $params = []) {
		return $this->sendRequest('person-profile/v1/profile/current', $params);
	}
	
	public function getPaymentsHistory(Array $params = []) {
		return $this->sendRequest('payment-history/v2/persons/' . $this->_phone . '/payments', $params);
	}
	
	public function getPaymentsStats(Array $params = []) {
		return $this->sendRequest('payment-history/v2/persons/' . $this->_phone . '/payments/total', $params);
	}
	
	public function getTxn($txnId, Array $params = []) {
		return $this->sendRequest('payment-history/v2/transactions/' . $txnId . '/', $params);
	}
	
	public function getCheck($txnId, Array $params = []) {
		return $this->sendRequest('payment-history/v1/transactions/' . $txnId . '/cheque/file', $params);
	}
	
	public function getBalance() {
		return $this->sendRequest('funding-sources/v2/persons/' . $this->_phone . '/accounts');
	}
	
	public function getTax($providerId) {
		return $this->sendRequest('sinap/providers/' . $providerId);
	}

    public function getComission($providerId, Array $params = []) {
        return $this->sendRequest('sinap/providers/'.$providerId.'/onlineCommission', $params, 1);
    }

	public function sendMoneyToQiwi(Array $params = []) {
		return $this->sendRequest('sinap/api/v2/terms/99/payments', $params, 1);
	}
	
	public function sendMoneyToProvider($providerId, Array $params = []) {
		return $this->sendRequest('sinap/api/v2/terms/' . $providerId . '/payments', $params, 1);
	}
	
	public function sendMoneyToOther(Array $params = []) {
		return $this->sendRequest('sinap/api/v2/terms/1717/payments', $params, 1);
	}
	
}
