<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '系统配置';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div>

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

            <?= $form->field($model, 'shipName')->textInput() ?>

            <?= $form->field($model, 'shipPhone')->textInput() ?>

            <?= $form->field($model, 'shipCity')->textInput() ?>

            <?= $form->field($model, 'shipCompany')->textInput() ?>

            <?= $form->field($model, 'shipAddress')->textInput() ?>

            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-11">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
