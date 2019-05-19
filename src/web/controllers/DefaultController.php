<?php

namespace yii2bundle\qiwi\web\controllers;

use yii\web\Controller;
use yii2rails\domain\data\Query;

class DefaultController extends Controller
{
	
	public function actionIndex()
	{
		
		$query = new Query;
		$query->limit(100);
		$categoryDataProvider = \App::$domain->qiwi->category->getDataProvider($query);
		return $this->render('index', [
			'categoryDataProvider' => $categoryDataProvider,
		]);
	}

}
