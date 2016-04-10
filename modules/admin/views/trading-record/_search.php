<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TradingRecordSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="trading-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sn') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'userType') ?>

    <?= $form->field($model, 'tradingType') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'startAmount') ?>

    <?php // echo $form->field($model, 'endAmount') ?>

    <?php // echo $form->field($model, 'itemType') ?>

    <?php // echo $form->field($model, 'itemId') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
