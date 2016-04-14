<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

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