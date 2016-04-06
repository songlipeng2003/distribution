<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = '更新区域: ' . ' ' . $model->region_id;
$this->params['breadcrumbs'][] = ['label' => '区域', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->region_id, 'url' => ['view', 'id' => $model->region_id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
