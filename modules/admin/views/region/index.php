<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '区域';
$this->params['breadcrumbs'][] = ['label' => '区域', 'url' => ['index']];
$this->params['breadcrumbs'][] = '管理';
?>
<div class="region-index">

    <h1><?= Html::encode($this->title).'管理' ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建区域', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'region_id',
            'parent_id',
            'region_name',
            'sort_order',
            'area_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
