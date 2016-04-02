<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use app\modules\weixin\models\WeixinGroup;

/* @var $this yii\web\View */
/* @var $model app\modules\weixin\models\WeixinUser */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="weixin-user-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>


    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'groupId')->dropdownList(ArrayHelper::map(WeixinGroup::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
