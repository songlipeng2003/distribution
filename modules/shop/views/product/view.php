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
<div class="page">
    <h1><?= $model->name ?></h1>
    <span style="color:#6a6968"><?= $model->slogan ?></span>
    <br/><br/>

    <span class="orange">累计销量：</span><?= $model->saledNumber ?>
    <span class="orange am-fr">购买<span style="color:black;">1</span>份成为代言人</span>

    <div class="price-line">
        <span class="price">￥<?= $model->price ?></span>
        <?php if($model->originalPrice){ ?>
        <del>￥
            <?= $model->originalPrice ?>
        </del>
        <?php } ?>
        <br/>
    </div>
</div>

<div class="page">
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
