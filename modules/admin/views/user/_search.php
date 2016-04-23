<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\UserSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'weixin') ?>

    <?= $form->field($model, 'parentId') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <?php // echo $form->field($model, 'lastLoginedAt') ?>

    <?php // echo $form->field($model, 'level1Number') ?>

    <?php // echo $form->field($model, 'level2Number') ?>

    <?php // echo $form->field($model, 'level3Number') ?>

    <?php // echo $form->field($model, 'employeeId') ?>

    <?php // echo $form->field($model, 'monthLimit') ?>

    <?php // echo $form->field($model, 'thisMonthIncome') ?>

    <?php // echo $form->field($model, 'totalIncome') ?>

    <?php // echo $form->field($model, 'userType') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
