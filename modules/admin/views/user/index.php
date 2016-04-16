<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' =>'id',
                'headerOptions' => ['style' => 'width:50px']
            ],
            'nickname',
            // 'parentId',
            [
                'attribute' =>'avatar',
                'format' => 'raw',
                'value' => function($model){
                    return $model->weixinUser ? Html::img($model->weixinUser->getAvatarUrl(64)) : null;
                },
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'level1Number',
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'level2Number',
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'level3Number',
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'employeeId',
                'headerOptions' => ['style' => 'width:100px'],
                'value' => function($model){
                    return $model->employee ? $model->employee->name : null;
                }
            ],
            [
                'attribute' =>'monthLimit',
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'thisMonthIncome',
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'totalIncome',
                'headerOptions' => ['style' => 'width:50px']
            ],
            [
                'attribute' =>'userType',
                'filter' => Html::activeDropDownList($searchModel, 'userType', User::$userTypes, ['class' => 'form-control', 'prompt' => '请选择']),
                'headerOptions' => ['style' => 'width:80px'],
                'value' => function($model){
                    return $model->userTypeText;
                }
            ],
            'createdAt',
            'lastLoginedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]); ?>

</div>
