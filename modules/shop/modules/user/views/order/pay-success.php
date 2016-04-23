<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '支付成功';
?>
<header data-am-widget="header" class="am-header am-header-default">
    <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="success-page page">
    <img src="/img/shop/pay-success.jpg" alt="" style="width: 50%">

    <p>
        恭喜您下单成功成为我们的代言人，您的包裹已经整装待发了！<br/>
        快去“代言人中心”赚取代言费吧！
    </p>

    <hr>

    <a class="am-btn am-btn-primary" href="<?= Url::to(['/shop/user/']) ?>">前往代言人中心</a>

</div>