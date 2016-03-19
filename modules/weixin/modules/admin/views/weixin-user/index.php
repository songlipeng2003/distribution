<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\weixin\models\search\WeixinUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weixin Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weixin-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'openid',
            // 'username',
            'nickname',
            'city',
            // 'avatar',
            // 'language',
            // 'province',
            // 'country',
            'remark',
            'groupId',
            'subscribeTime',
            'createdAt',
            // 'updatedAt'

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}' 
            ],
        ],
    ]); ?>

</div>
