<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use yii\web\JqueryAsset;

$this->title = '快速结账';
?>
<header data-am-widget="header" class="am-header am-header-default">
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
    <div class="am-fr">
        <span class="am-icon-md am-icon-minus" id="op_minus"></span>
        <span data-number style="font-size: 26px; padding: 4px 5px;">1</span>
        <span class="am-icon-md am-icon-plus" id="op_plus"></span>
    </div>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
<div>
    购物车总价:已选<em data-number>1</em>份 共计 <em data-price="<?= $model->price ?>" id="total_price"><?= $model->price ?></em>元
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
<h2>收货人信息</h2>
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
        <label class="am-u-sm-4 am-form-label">省：</label>
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
        <label class="am-u-sm-4 am-form-label">区：</label>
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
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default " id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-1">
        <li>
            <a id="checkout" href="<?= Url::to(['cart/quick-checkout', 'id' => $model->id]) ?>" class="">
                <span class="am-navbar-label">立即购买并成为合伙人</span>
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
