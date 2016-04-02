<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

use app\modules\weixin\models\WeixinGroup;
use app\modules\weixin\models\WeixinUser;

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

            [
                'attribute' => 'id', 
                'headerOptions' => ['style' => 'width:80px'],
            ],
            // 'openid',
            [
                'attribute' => 'avatar', 
                'headerOptions' => ['style' => 'width:80px'],
                'format' => 'raw',
                'value' => function($model){
                    return Html::img($model->avatar, ['width' => 80]);
                }
            ],
            'nickname',
            [
                'attribute' => 'sex',
                'filter' => Html::activeDropDownList($searchModel, 'sex', WeixinUser::$sexes, ['class' => 'form-control', 'prompt' => '请选择']),
                'value' => function($model){
                    return $model->sexText;
                },
                'headerOptions' => ['style' => 'width:90px'],
            ],
            'city',
            // 'avatar',
            // 'language',
            // 'province',
            // 'country',
            // 'remark',
            [
                'attribute' => 'groupId',
                'filter' => Html::activeDropDownList($searchModel, 'groupId', ArrayHelper::map(WeixinGroup::find()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '请选择']),
                'value' => function($model){
                    return $model->weixinGroup ? $model->weixinGroup->name : '';
                },
                'headerOptions' => ['style' => 'width:100px'],
            ],
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
