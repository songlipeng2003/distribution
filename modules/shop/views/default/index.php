<?php

use yii\helpers\Html;

$this->title = '吃货榜样';
?>
<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<?php if($lastNotice){ ?>
<div class="page am-cf">
    <div class="am-u-sm-3 notice-title">
        <h2 style="font-size: 18px;">吃货<br/>公告</h2>
    </div>
    <div class="am-u-sm-9 notice-content">
        <img src="/img/shop/notice.png" alt="" style="width:80px;"><br/>
        <?= nl2br($lastNotice->content)?>
    </div>
</div>
<?php } ?>

<?php foreach ($products as $product) { ?>
    <div class="product-item">
    <?=  $product->getImage() ? Html::a(Html::img($product->getImage()->getUrl('500px')), ['product/view', 'id' => $product->id]) : '' ?>

        <div class="info">
            <h2><?= $product->name ?></h2>
            <span class="orange"><?= $product->slogan ?></span> 
            <span class="am-fr"><?php if($product->originalPrice){ ?> <del>￥<?= $product->originalPrice ?></del><?php } ?></span>

            <!-- <span class="price">￥<?= $product->price ?></span> -->
            
        </div>
    </div>
<?php } ?>

<?= $this->render('../elements/bottom') ?>

