<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\weixin\models\WeixinArticle;

/* @var $this yii\web\View */
/* @var $model app\modules\weixin\models\WeixinRule */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="weixin-rule-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true])->hint("*表示不匹配其他时，匹配这条记录") ?>

    <?= $form->field($model, 'reply')->textArea(['rows' => 8]) ?>

    <?php //$form->field($model, 'weixinArticleId')->dropdownList(ArrayHelper::map(WeixinArticle::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
