<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\weixin\models\search\WeixinRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weixin Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weixin-rule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'keyword',
                'headerOptions' => ['style' => 'width: 120px;']
            ],
            'reply:html',
            //'weixinArticleId',
            [
                'attribute' => 'createdAt',
                'headerOptions' => ['style' => 'width: 100px;']
            ],
            [
                'attribute' => 'updatedAt',
                'headerOptions' => ['style' => 'width: 100px;']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 100px;']
            ],
        ],
    ]); ?>

</div>
