<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TradingRecord */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trading Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trading-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sn',
            'userId',
            'userType',
            'tradingType',
            'name',
            'amount',
            'startAmount',
            'endAmount',
            'itemType',
            'itemId',
            'remark',
            'createdAt',
        ],
    ]) ?>

</div>
