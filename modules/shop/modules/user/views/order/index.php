<?php 
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\Order;

$this->title = '订单';
?>

<!-- <header data-am-widget="header" class="am-header am-header-default">
    <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header> -->

<div class="page">
    <table class="am-table">
        <tr>
            <td>订单号</td>
            <td>下单时间</td>
            <td>金额</td>
            <td>订单状态</td>
        </tr>
        <?php foreach ($dataProvider->getModels() as $key => $order){ ?>
        <tr>
            <td><?= $order->sn ?></td>
            <td><?= substr($order->createdAt, 2, 8) ?></td>
            <td><?= $order->totalAmount ?></td>
            <td><?= $order->statusText ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?= $this->render('../elements/bottom') ?>
