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
            <?= Html::img($image->getUrl('300*300')) ?>
        </li>
        <?php } ?>
    </ul>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
<div>
    <h2>世界这么大，我想要吃掉它！</h2>
    <p>
        本零食大礼包专为吃货精心准备，囊获全球22款零食，一次吃够
    </p>
    <div class="price-line">
        <span class="price">￥<?= $model->price ?></span>
        <?php if($model->originalPrice){ ?>
        <del>￥
            <?= $model->originalPrice ?>
        </del>
        <?php } ?>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
<div class="">
    <h3>商品详情</h3>
    <?= $model->content ?>
</div>
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-1">
        <li>
            <a href="<?= Url::to(['cart/quick-checkout', 'id' => $model->id]) ?>" class="">
                <span class="am-navbar-label">立即购买并成为合伙人</span>
            </a>
        </li>
    </ul>
</div>
