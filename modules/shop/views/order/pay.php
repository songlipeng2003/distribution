<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '订单支付';
?>
<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<?php 
$this->registerJsFile('/js/pingpp.js');
?>
<?php 
$this->registerJsFile('/js/shop/pay.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>