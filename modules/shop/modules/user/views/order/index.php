<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '订单';
?>

<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="am-panel-group">
<?php foreach ($dataProvider->getModels() as $key => $order): ?>
    <div class="am-panel am-panel-default">
        <div class="am-panel-hd">
            订单号：<?= $order->sn ?>
            <div class="am-fr">
                <?= substr($order->createdAt, 0, 10) ?>
            </div>
        </div>
        <div class="am-panel-bd">
            <p>商品：<?= $order->product->name ?> 数量：<?= $order->product->quantity ?></p>
        </div>
        <div class="am-panel-footer am-cf">
            <a class="am-btn am-btn-primary am-fr " href="<?= Url::to(['view', 'id' => $order->id]) ?>">订单详情</a>
            <a class="am-btn am-btn-primary am-fr am-margin-right" href="<?= Url::to(['pay', 'id' => $order->id]) ?>" target="_blank">支付</a>
        </div>
    </div>
<?php endforeach ?>
</div>

<?= $this->render('../elements/bottom') ?>