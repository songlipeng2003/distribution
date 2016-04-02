<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '订单';
?>

<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<?= $this->render('../elements/bottom') ?>