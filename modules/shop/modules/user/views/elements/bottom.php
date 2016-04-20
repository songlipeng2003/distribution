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
            <a href="<?= Url::to(['/shop/user/spread']) ?>" class="">
                <img src="/img/shop/nav/qrcode.png" alt="">
            </a>
        </li>
    </ul>
</div>
