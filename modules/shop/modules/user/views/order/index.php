<?php 
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\Order;

$this->title = '订单';
?>

<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="am-panel-group">
<?php foreach ($dataProvider->getModels() as $key => $order){ ?>
    <div class="am-panel am-panel-default">
        <div class="am-panel-hd">
            订单号：<?= $order->sn ?>
            <div class="am-fr">
                <?= $order->statusText ?>
            </div>
        </div>
        <div class="am-panel-bd">
            <p>
                <?= Html::img($order->product->getImage()->getUrl(200)) ?> 
                商品：<?= $order->product->name ?> 
                数量：<?= $order->product->quantity ?>
                <span class="am-fr">
                    <?= substr($order->createdAt, 0, 10) ?>
                </span>
            </p>
        </div>
        <div class="am-panel-footer am-cf">
            <a class="am-btn am-btn-primary am-fr " href="<?= Url::to(['view', 'id' => $order->id]) ?>">订单详情</a>
            <?php if($order->status==Order::STATUS_UNPAYED){ ?>
            <a class="am-btn am-btn-primary am-fr am-margin-right" href="<?= Url::to(['pay', 'id' => $order->id]) ?>" target="_blank">支付</a>
            <? } ?>
        </div>
    </div>
<?php } ?>
</div>

<?= $this->render('../elements/bottom') ?>