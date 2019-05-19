<?php

/* @var $this yii\web\View */
/* @var $providerEntity \yii2bundle\qiwi\domain\entities\ProviderEntity */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = $providerEntity->short_name;
//d($providerEntity);

?>

<div class="welcome-index">

    <h2>
		<?= \yii\helpers\Html::img($providerEntity->logo_url, ['height' => '64px']) . SPC . $this->title ?>
    </h2>
    
    <div class="row">
        <div class="col-md-12">
			<?= $providerEntity->long_name ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
	        <?php $form = ActiveForm::begin(); ?>
	
	        <?= $form->field($model, 'amount')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
		        <?= Html::submitButton(Yii::t('qiwi/provider', 'pay'), ['class' => 'btn btn-primary']) ?>
            </div>
	
	        <?php ActiveForm::end(); ?>
        </div>
    </div>
    
</div>
