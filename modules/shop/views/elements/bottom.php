<?php 
use yii\helpers\Url;
?>
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "
id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4">
        <li >
            <a href="<?= Url::to(['/shop/']) ?>" class="">
                <img src="/img/shop/nav/home.png" alt="">
            </a>
        </li>
        <li >
            <a href="<?= Url::to(['/shop/user/order']) ?>" class="">
                <img src="/img/shop/nav/order.png" alt="">
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['/shop/user/']) ?>" class="">
                <img src="/img/shop/nav/user.png" alt="">
            </a>
        </li>
        <li >
            <a href="javascript:void(0)" class="op-qrcode">
                <img src="/img/shop/nav/qrcode.png" alt="">
            </a>
        </li>
    </ul>
</div>

<div class="am-modal am-modal-alert" tabindex="-1" id="qrcode-alert">
    <div class="am-modal-dialog">
        <div class="am-modal-bd">
            <span id="alert-msg"><span><br/>
            <button class="am-btn am-btn-primary" style="padding: 0.5em 3em" click="wx.closeWindow();">去看看</button>
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn">关闭</span>
        </div>
    </div>
</div>
