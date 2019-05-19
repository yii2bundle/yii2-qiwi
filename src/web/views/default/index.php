<?php

/* @var $this yii\web\View */
/* @var $categoryCollection \yii2bundle\qiwi\domain\entities\CategoryEntity[] */
/* @var $categoryDataProvider \yii\data\DataProviderInterface */

$this->title = Yii::t('qiwi/provider', 'title');
$categoryCollection = $categoryDataProvider->getModels();

?>

<div class="welcome-index">

    <h2>
        <?= $this->title ?>
    </h2>

    <div class="row">
        <div class="col-md-12">
	        <?php foreach($categoryCollection as $categoryEntity) { ?>
		        <?php
		        $url = \yii\helpers\Url::to(['/qiwi/provider/index', 'category_id' => $categoryEntity->id]);
		        ?>
                <div class="col-sm-6 col-md-2">
			        <?= \yii2bundle\qiwi\web\widgets\Thumb::widget([
				        'url' => $url,
				        'logoUrl' => $categoryEntity->logo_url,
				        'title' => $categoryEntity->name,
			        ]) ?>
                </div>
	        <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
	        <?= \yii\widgets\LinkPager::widget([
		        'pagination' => $categoryDataProvider->pagination,
	        ]) ?>
        </div>
    </div>
    
</div>
