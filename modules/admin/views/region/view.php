<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = $model->region_id;
$this->params['breadcrumbs'][] = ['label' => '区域', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-view">

    <h1><?= '查看区域';//Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'region_id',
            'parent_id',
            'region_name',
            'sort_order',
            'area_type',
        ],
    ]) ?>

</div>
