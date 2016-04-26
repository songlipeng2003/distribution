<?php

use yii\helpers\Html;

$this->title = '吃货榜样';
?>
<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<?php if($lastNotice){ ?>
<!-- <div class="page am-cf">
    <div class="am-u-sm-3 notice-title">
    &nbsp;
    </div>
    <div class="am-u-sm-9 notice-content">
        <img src="/img/shop/notice.png" alt="" style="width:80px;"><br/>
        <?= nl2br($lastNotice->content)?>
    </div>
</div> -->
<?php } ?>

<img src="/img/shop/notice-1.jpg" alt="" style="margin-bottom: 10px;">

<?php foreach ($products as $product) { ?>
    <div class="product-item">
    <?=  $product->getImage() ? Html::a(Html::img($product->getImage()->getUrl('500px')), ['product/view', 'id' => $product->id]) : '' ?>

        <div class="info">
            <h2><?= $product->name ?><span class="am-fr price">￥<?= $product->price ?></span></h2>
            <div>
                <span class="orange"><?= $product->slogan ?>
                <span class="am-fr"><?php if($product->originalPrice){ ?> <del>￥<?= $product->originalPrice ?></del><?php } ?></span></span> 
            </div>
        </div>
    </div>
<?php } ?>

<?= $this->render('../elements/bottom') ?>

