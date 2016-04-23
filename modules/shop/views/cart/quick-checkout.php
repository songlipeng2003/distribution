<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use yii\web\JqueryAsset;

$this->title = '快速结账';
?>
<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="<?= Url::to(['/shop/product/view', 'id' => $model->id]) ?>">
            <i class="am-icon-chevron-left" ></i>
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
    <h1>
        <?= $model->name ?>
        <div class="am-fr">
            <img src="/img/shop/minus.jpg" alt="" id="op_minus" style="width: 35px;">
            <span data-number style="font-size: 26px; padding: 4px 5px;">1</span>
            <img src="/img/shop/plus.jpg" alt="" id="op_plus" style="width: 35px;">
        </div>
    </h1>

    购物总计：已选<span class="orange" data-number>1</span>份
    共计 <span class="orange" data-price="<?= $model->price ?>" data-total-price><?= $model->price ?></span>元

    <hr>
    <h3>购买须知</h3>
    <p>
    感谢您对眯糊时光的支持，同时也恭喜您购买成功后就成为我们的代言人
    ，可以在帮助我们推广品牌的同时获得不菲的代言费回报。请您在购买时
    填写详细的收货地址信息和电话，以确保能快速的收到货物
    </p>
</div>

<div class="page">
<form id="checkout_form" class="am-form am-form-horizontal" novalidate="" method="post">
    <input type="hidden" id="quantity" name="QuickCheckoutForm[quantity]" value="1">
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">收货人：</label>
        <div class="am-u-sm-8">
            <input type="text" name="QuickCheckoutForm[name]" placeholder="" required>
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">联系电话：</label>
        <div class="am-u-sm-8">
            <input type="text" name="QuickCheckoutForm[phone]" placeholder="" required minlength="11" maxlength="11">
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">省份：</label>
        <div class="am-u-sm-8">
            <select id="province_id" name="QuickCheckoutForm[provinceId]" required>
                <option value="">请选择</option>
            </select>
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">市：</label>
        <div class="am-u-sm-8">
            <select id="city_id" name="QuickCheckoutForm[cityId]" required>
                <option value="">请选择</option>
            </select>
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">县/区：</label>
        <div class="am-u-sm-8">
            <select id="region_id" name="QuickCheckoutForm[regionId]" required>
                <option value="">请选择</option>
            </select>
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">详细地址</label>
        <div class="am-u-sm-8">
            <input type="text" name="QuickCheckoutForm[address]" placeholder="" required minlength="5" maxlength="30">
        </div>
    </div>
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">备注</label>
        <div class="am-u-sm-8">
            <input type="text" name="QuickCheckoutForm[remark]" placeholder="">
        </div>
    </div>
</form>
</div>

<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-1">
        <li>
            <a id="checkout" href="<?= Url::to(['cart/quick-checkout', 'id' => $model->id]) ?>" class="">
                <span class="am-navbar-label">立即支付<span data-total-price></span>成为代言人</span>
            </a>
        </li>
    </ul>
</div>
<?php 
$this->registerJsFile('https://cdn.bootcss.com/jquery-validate/1.15.0/jquery.validate.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>
<?php 
$this->registerJsFile('/js/jquery.form.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>
<?php 
$this->registerJsFile('/js/message_zh.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>
<?php 
$this->registerJsFile('/js/shop/cart.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>
