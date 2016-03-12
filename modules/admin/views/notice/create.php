<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notice */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
