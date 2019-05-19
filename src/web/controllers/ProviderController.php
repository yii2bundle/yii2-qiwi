<?php

namespace yii2bundle\qiwi\web\controllers;

use yii\web\Controller;
use yii2rails\domain\data\Query;

class ProviderController extends Controller
{
	
	public function actionIndex($category_id)
	{
		$categoryEntity = \App::$domain->qiwi->category->oneById($category_id);
		$query = new Query;
		$query->andWhere(['category_id' => $category_id]);
		$query->limit(24);
		$providerDataProvider = \App::$domain->qiwi->provider->getDataProvider($query);
		return $this->render('index', [
			'categoryEntity' => $categoryEntity,
			'providerDataProvider' => $providerDataProvider,
		]);
	}

}
