<?php

use yii\helpers\Html;

$this->title = Yii::$app->name;
?>
<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<p>
    <?= $lastNotice ? $lastNotice->content : '' ?>
</p>

<?php foreach ($products as $product) { ?>
    <div>
    <?=  $product->getImage() ? Html::a(Html::img($product->getImage()->getUrl('500px')), ['product/view', 'id' => $product->id]) : '' ?>
    </div>
<? } ?>

<?= $this->render('../elements/bottom') ?>

