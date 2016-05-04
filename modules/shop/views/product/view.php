<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
?>
<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="<?= Url::to(['/shop/']) ?>">
            <i class="am-icon-chevron-left"></i>
        </a>
    </div>
    <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>
<div class="am-slider am-slider-default" data-am-flexslider>
    <ul class="am-slides">
        <?php foreach ($images as $key => $image) { ?>
        <li>
            <?= Html::img($image->getUrl()) ?>
        </li>
        <?php } ?>
    </ul>
</div>
<div class="page">
    <h1><?= $model->name ?></h1>
    <span style="color:#6a6968"><?= $model->slogan ?></span>
    <br/><br/>

    <span class="orange">累计销量:</span> <?= $model->saledNumber ?>
    &nbsp;&nbsp;&nbsp;&nbsp;<span class="orange">快递:</span> 0.00
    <span class="orange am-fr">购买 <span style="color:black;">1</span> 份成为代言人</span>
</div>

<div class="page product-content">
    <?= $model->content ?>
</div>

<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default" id="product-buy-bar">
    <div class="am-u-sm-5">
        <a href="<?= Url::to(['cart/quick-checkout', 'id' => $model->id]) ?>" class="">
            <span class="am-navbar-label">活动价仅<?= $model->price ?>元</span>
        </a>
    </div>
    <div class="am-u-sm-7">
        <a href="<?= Url::to(['cart/quick-checkout', 'id' => $model->id]) ?>" class="">
            <span class="am-navbar-label">立即购买并成为代言人</span>
        </a>
    </div>
</div>
