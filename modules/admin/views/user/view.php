<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // 'username',
            // 'password',
            // 'weixin',
            'nickname',
            [
                'attribute' => 'avatar',
                'format' => 'raw',
                'value' => $model->weixinUser ? Html::img($model->weixinUser->getAvatarUrl(64)) : null
            ],
            'parentId',
            // 'token',
            'createdAt',
            'updatedAt',
            'lastLoginedAt',
            'level1Number',
            'level2Number',
            'level3Number',
            'employeeId',
            'monthLimit',
            'thisMonthIncome',
            'totalIncome',
            [
                'attribute' => 'userType',
                'value' => $model->userTypeText
            ],
        ],
    ]) ?>

</div>
