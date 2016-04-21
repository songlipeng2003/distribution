<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '我的推广码';
?>

<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<h1>我的推广码</h1>

<p>请使用微信扫描下面二维码</p>

<!-- <img src="<?= Url::to(['/site/qrcode', 'text' => $url]) ?>" alt=""> -->
<img src="<?= $url ?>" alt="">

<?= $this->render('../elements/bottom') ?>