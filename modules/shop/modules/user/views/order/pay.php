<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->title = '订单支付';
?>
<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="javascript:history.back();">
            <i class="am-icon-chevron-left" ></i>
        </a>
    </div>
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div style="font-size: 24px; text-align: center; padding: 100px 5px;">
    支付金额：<?= $model->totalAmount ?>元
</div>

<?php 
$this->registerJsFile('/js/pingpp.js');
?>
<?php 
$this->registerJsFile('/js/shop/pay.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>