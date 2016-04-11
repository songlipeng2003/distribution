<?php

use yii\helpers\Html;

$this->title = '吃货榜样';
?>
<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<?php if($lastNotice){ ?>
<div>
    <div class="am-u-sm-3 notice-title">
        <h2 class="">吃货<br/>公告</h2>
    </div>
    <div class="am-u-sm-9 notice-content">
        <?= nl2br($lastNotice->content)?>
    </div>
</div>
<?php } ?>

<?php foreach ($products as $product) { ?>
    <div class="product_item">
    <?=  $product->getImage() ? Html::a(Html::img($product->getImage()->getUrl('500px')), ['product/view', 'id' => $product->id]) : '' ?>

    <div class="price_line">
        <span class="price">￥<?= $product->price ?></span>
        <?php if($product->originalPrice){ ?> <del>￥<?= $product->originalPrice ?></del><?php } ?>
    </div>
    </div>
<?php } ?>

<?= $this->render('../elements/bottom') ?>

