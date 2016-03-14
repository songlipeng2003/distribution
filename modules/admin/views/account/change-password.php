<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '修改密码';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div>

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

            <?= $form->field($model, 'oldPassword')->passwordInput() ?>

            <?= $form->field($model, 'newPassword')->passwordInput() ?>

            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-11">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
