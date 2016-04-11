<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = '创建区域';
$this->params['breadcrumbs'][] = ['label' => '区域', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
