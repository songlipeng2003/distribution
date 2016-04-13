<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Employee;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

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
            'username',
            // 'password',
            'name',
            // 'email:email',
            'phone',
            'rate',
            // 'token',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->statusText;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', Employee::$statuses, ['class' => 'form-control', 'prompt' => '请选择']),
                'headerOptions' => ['style' => 'width:100px;']
            ],
            'createdAt',
            // 'updatedAt',
            'lastLoginedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
