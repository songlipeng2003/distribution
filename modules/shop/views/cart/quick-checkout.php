<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '快速结账';
?>
<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="am-slider am-slider-default" data-am-flexslider>
  <ul class="am-slides">
    <?php foreach ($images as $key => $image) { ?>
    <li><?= Html::img($image->getUrl('300*300')) ?></li>
    <?php } ?>
  </ul>
</div>

 <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<div>
  <h2>世界这么大，我想要吃掉它！</h2>
  <p>
    本零食大礼包专为吃货精心准备，囊获全球22款零食，一次吃够
  </p>
</div>

<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<div>
购物车总价:已选<em id="">1</em>份 共计 <em id=""></em>元  
</div>

<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<h2>收货人信息</h2>
<form class="am-form am-form-horizontal">
  <div class="am-form-group">
    <label class="am-u-sm-4 am-form-label">收货人：</label>
    <div class="am-u-sm-8">
      <input type="email" placeholder="">
    </div>
  </div>

  <div class="am-form-group">
    <label class="am-u-sm-4 am-form-label">联系电话：</label>
    <div class="am-u-sm-8">
      <input type="email" placeholder="">
    </div>
  </div>

  <div class="am-form-group">
    <label class="am-u-sm-4 am-form-label">收货地址：</label>
    <div class="am-u-sm-8">
      <input type="email" placeholder="">
    </div>
  </div>

  <div class="am-form-group">
    <label class="am-u-sm-4 am-form-label">详细地址</label>
    <div class="am-u-sm-8">
      <input type="email" placeholder="">
    </div>
  </div>

  <div class="am-form-group">
    <label class="am-u-sm-4 am-form-label">备注</label>
    <div class="am-u-sm-8">
      <input type="email" placeholder="">
    </div>
  </div>
</form>

<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "
id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-1">
        <li >
            <a href="<?= Url::to(['cart/quick-checkout', 'id' => $model->id]) ?>" class="">
                <span class="am-navbar-label">立即购买并成为合伙人</span>
            </a>
        </li>
    </ul>
</div>
