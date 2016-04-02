<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\weixin\models\WeixinUser */

$this->title = $model->nickname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weixin Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weixin-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'openid',
            'nickname',
            [
                'attribute' => 'sex',
                'value' => $model->sexText
            ],
            'city',
            'avatar:image',
            'language',
            'province',
            'country',
            'remark',
            [
                'attribute' => 'groupId',
                'value' => $model->weixinGroup ? $model->weixinGroup->name : ''
            ],
            'subscribeTime',
            'createdAt',
            'updatedAt',
            'lastMessageAt'
        ],
    ]) ?>

</div>
