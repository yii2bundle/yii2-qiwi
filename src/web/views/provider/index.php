<?php

/* @var $this yii\web\View */
/* @var $providerCollection \yii2bundle\qiwi\domain\entities\ProviderEntity[] */
/* @var $providerDataProvider \yii\data\DataProviderInterface */
/* @var $categoryEntity \yii2bundle\qiwi\domain\entities\CategoryEntity */

$this->title = $categoryEntity->name;
$providerCollection = $providerDataProvider->getModels();

?>

<div class="welcome-index">

    <h2>
		<?= $this->title ?>
    </h2>
    
	<?php foreach($providerCollection as $providerEntity) { ?>
		
		<?php
		$logoUrl = $providerEntity->logo_url ? $providerEntity->logo_url : $categoryEntity->logo_url;
		$title = \yii\helpers\Html::img($logoUrl) . SPC . $providerEntity->short_name;
		$url = \yii\helpers\Url::to(['/qiwi/provider/view', 'id' => $providerEntity->id]);
		?>
        
        <div class="col-sm-6 col-md-2">
	        <?= \yii2bundle\qiwi\web\widgets\Thumb::widget([
	            'url' => $url,
		        'logoUrl' => $logoUrl,
		        'title' => $providerEntity->short_name,
            ]) ?>
        </div>
	
	<?php } ?>

    <div class="row">
        <div class="col-md-12">
			<?= \yii\widgets\LinkPager::widget([
				'pagination' => $providerDataProvider->pagination,
			]) ?>
        </div>
    </div>
    
</div>
