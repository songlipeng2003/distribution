<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\weixin\models\WeixinArticle */

$this->title = Yii::t('app', 'Update') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weixin Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="weixin-article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($form, [
        'model' => $model,
    ]) ?>

</div>
