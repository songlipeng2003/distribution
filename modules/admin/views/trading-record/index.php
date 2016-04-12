<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\TradingRecord;
use app\models\Finance;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TradingRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Trading Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trading-record-index">

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
            [
                'attribute' => 'sn',
                'headerOptions' => ['style' => 'width: 120px']
            ],
            'userId',
            [
                'attribute' => 'userType',
                'headerOptions' => ['style' => 'width: 90px'],
                'filter' => Html::activeDropDownList($searchModel, 'userType', Finance::$userTypes, ['class' => 'form-control', 'prompt' => '请选择']),
                'value' => function($model){
                    return $model->userTypeText;
                }
            ],
            'tradingType',
            [
                'attribute' => 'tradingType',
                'headerOptions' => ['style' => 'width: 90px'],
                'filter' => Html::activeDropDownList($searchModel, 'tradingType', TradingRecord::$tradingTypes, ['class' => 'form-control', 'prompt' => '请选择']),
                'value' => function($model){
                    return $model->tradingTypeName;
                }
            ],
            'name',
            'amount',
            'startAmount',
            'endAmount',
            // 'itemType',
            // 'itemId',
            // 'remark',
            'createdAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>

</div>
