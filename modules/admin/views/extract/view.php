<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Extract */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userId',
            'amount',
            'toAmount',
            [
                'attribute' => 'status',
                'value' => $model->statusText
            ],
            'weixinRedEnvelope',
            'transactionNo',
            'createdAt',
            'operatedAt',
        ],
    ]) ?>

</div>
