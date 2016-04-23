<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\weixin\models\WeixinRule */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weixin Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weixin-rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($form, [
        'model' => $model,
    ]) ?>

</div>
