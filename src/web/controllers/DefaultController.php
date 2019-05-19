<?php

namespace yii2bundle\qiwi\web\controllers;

use yii\web\Controller;
use yii2rails\domain\data\Query;

class DefaultController extends Controller
{
	
	public function actionIndex()
	{
		\App::$domain->qiwi->person->auth('77783177384', 'b233d83635d03c870ef492e72bd46009');
		$query = new Query;
		$query->limit(100);
		$categoryDataProvider = \App::$domain->qiwi->category->getDataProvider($query);
		return $this->render('index', [
			'categoryDataProvider' => $categoryDataProvider,
		]);
	}

}
