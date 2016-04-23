<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\weixin\models\WeixinArticle;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\weixin\models\search\WeixinArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weixin Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weixin-article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建文字回复', ['create', 'type' => WeixinArticle::SCENARIO_TEXT], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'title',
            'cover',
            // 'description',
            // 'link',
            // 'content:ntext',
            'createdAt',
            // 'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
