<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Extract;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExtractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Extracts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extract-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'userId',
                'value' => function($model){
                    return $model->user->nickname;
                }
            ],
            'amount',
            'toAmount',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', Extract::$statuses, ['class' => 'form-control', 'prompt' => '请选择']),
                'value' => function($model){
                    return $model->statusText;
                },
                'headerOptions' => ['style' => 'width:90px'],
            ],
            'createdAt',
            'operatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>

</div>
