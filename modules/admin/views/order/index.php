<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Order;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width: 50px']
            ],
            'sn',
            [
                'attribute' => 'productId',
                'value' => function($model){
                    return $model->product->name;
                }
            ],
            [
                'attribute' => 'quantity',
                'headerOptions' => ['style' => 'width: 60px']
            ],
            'price',
            'totalAmount',
            [
                'attribute' => 'status',
                'headerOptions' => ['style' => 'width: 90px'],
                'filter' => Html::activeDropDownList($searchModel, 'status', Order::$statuses, ['class' => 'form-control', 'prompt' => '请选择']),
                'value' => function($model){
                    return $model->statusText;
                }
            ],
            'createdAt',
            'payedAt',
            // 'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {send}',
                'buttons' => [
                    'send' => function($url, $model, $key){
                        return Html::a('发货', $url);
                    }
                ],
                'visibleButtons' => [
                    'send' => function($model){
                        return $model->status==Order::STATUS_PAYED;
                    },
                ]
            ],
        ],
    ]); ?>

</div>
