<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\models\Order;

$this->title = '打印快递单';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order->sn, 'url' => ['view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'expressId')->dropdownList(Order::$expresses) ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-11">
            <?= Html::submitButton('打印', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
