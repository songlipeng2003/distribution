<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\Order;

$this->title = '订单详情';
?>
<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="javascript:history.back();">
            <i class="am-icon-chevron-left" ></i>
        </a>
    </div>
    <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="am-panel-group">
    <div class="am-panel am-panel-default">
        <div class="am-panel-hd">
            订单号：<?= $model->sn ?>
            <div class="am-fr">
                <?= $model->statusText ?>
            </div>
        </div>
        <div class="am-panel-bd">
            <p>
                <?= Html::img($model->product->getImage()->getUrl(200)) ?> 
                商品：<?= Html::a($model->product->name, ['/shop/product/view', 'id' => $model->productId]) ?> 
                数量：<?= $model->product->quantity ?>
                <span class="am-fr">
                    <?= substr($model->createdAt, 0, 10) ?>
                </span>
            </p>
        </div>
        <div class="am-panel-footer am-cf">
            <?php if($model->status==Order::STATUS_UNPAYED){ ?>
            <a class="am-btn am-btn-primary am-fr am-margin-right" href="<?= Url::to(['pay', 'id' => $model->id]) ?>" target="_blank">支付</a>
            <? } ?>
        </div>
    </div>
</div>