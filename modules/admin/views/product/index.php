<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

use app\models\Product;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

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

            'id',
            'name',
            [
                'attribute' =>'categoryId',
                'filter' => Html::activeDropDownList($searchModel, 'categoryId', ArrayHelper::map(Category::find()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => '请选择']),
                'headerOptions' => ['style' => 'width:100px'],
                'value' => function($model){
                    return $model->category ? $model->category->name : null;
                }
            ],
            'price',
            'quantity',
            'saledNumber',
            [
                'attribute' =>'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', Product::$statuses, ['class' => 'form-control', 'prompt' => '请选择']),
                'headerOptions' => ['style' => 'width:80px'],
                'value' => function($model){
                    return $model->statusText;
                }
            ],
            'createdAt',
            // 'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
