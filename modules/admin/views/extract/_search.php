<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ExtractSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="extract-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'toAmount') ?>

    <?= $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'operatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
