<?php 
use yii\helpers\Url;
?>
<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "
id="">
    <ul class="am-navbar-nav am-cf am-avg-sm-4">
        <li >
            <a href="<?= Url::to(['/shop/']) ?>" class="">
                <span class="am-navbar-label">首页</span>
            </a>
        </li>
        <li >
            <a href="<?= Url::to(['/shop/user/order']) ?>" class="">
                <span class="am-navbar-label">订单</span>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['/shop/user/']) ?>" class="">
                <span class="am-navbar-label">会员中心</span>
            </a>
        </li>
        <li >
            <a href="<?= Url::to(['/shop/user/spread']) ?>" class="">
                <span class="am-navbar-label">我的推广码</span>
            </a>
        </li>
    </ul>
</div>
