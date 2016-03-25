<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\weixin\models\search\WeixinUserSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="weixin-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'openid') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'groupId') ?>

    <?php // echo $form->field($model, 'subscribeTime') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <?php // echo $form->field($model, 'lastLoginedAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
