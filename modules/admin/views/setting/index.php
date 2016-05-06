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

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#site" aria-controls="site" role="tab" data-toggle="tab">网站设置</a>
                </li>
                <li role="presentation">
                    <a href="#weixin" aria-controls="weixin" role="tab" data-toggle="tab">公众号</a>
                </li>
                <li role="presentation">
                    <a href="#ship" aria-controls="ship" role="tab" data-toggle="tab">快递</a>
                </li>
                <li role="presentation">
                    <a href="#level" aria-controls="level" role="tab" data-toggle="tab">分销设置</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="site">
                    <?= $form->field($model, 'siteName')->textInput() ?>

                    <?= $form->field($model, 'siteDescription')->textInput() ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="weixin">
                    <?= $form->field($model, 'weixinName')->textInput() ?>

                    <?= $form->field($model, 'weixinCode')->textInput() ?>

                    <?= $form->field($model, 'weixinAppId')->textInput() ?>

                    <?= $form->field($model, 'weixinSecret')->textInput() ?>

                    <?= $form->field($model, 'weixinToken')->textInput() ?>

                    <?= $form->field($model, 'weixinAesKey')->textInput() ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="ship">
                    <?= $form->field($model, 'shipName')->textInput() ?>

                    <?= $form->field($model, 'shipPhone')->textInput() ?>

                    <?= $form->field($model, 'shipCity')->textInput() ?>

                    <?= $form->field($model, 'shipCompany')->textInput() ?>

                    <?= $form->field($model, 'shipAddress')->textInput() ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="level">
                    <?= $form->field($model, 'level1Number')->textInput()->hint("如果提成是5%，请输入0.05") ?>

                    <?= $form->field($model, 'level2Number')->textInput() ?>

                    <?= $form->field($model, 'level3Number')->textInput() ?>

                    <?= $form->field($model, 'levelUnlimitedNumber')->textInput() ?>

                    <?= $form->field($model, 'levelOfficialNumber')->textInput() ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-11">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
