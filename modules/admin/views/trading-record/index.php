<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'id',
            'sn',
            'userId',
            'userType',
            'tradingType',
            // 'name',
            // 'amount',
            // 'startAmount',
            // 'endAmount',
            // 'itemType',
            // 'itemId',
            // 'remark',
            // 'createdAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
