<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use kucha\ueditor\UEditor;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true])->hint('可不用填写') ?>

    <?php //$form->field($model, 'url')->textInput(['maxlength' => true])->hint('可不填写') ?>

    <?= $form->field($model, 'content')->widget(UEditor::className(), []) ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
