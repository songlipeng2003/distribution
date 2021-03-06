<?php 
use yii\helpers\Html;
use yii\helpers\Url;

use app\models\User;

$this->title = '个人中心';
?>

<style type="text/css" media="screen">
.circle-process .bar {
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
} 
</style>

<header data-am-widget="header" class="am-header am-header-default">
    <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="page am-cf">
    <div class="c100 p00 big orange proccess-cicle">
        <span class="title">本月销售额（元）</span>
        <span class="number"><?= $user->thisMonthSaleroom ?></span>
        <span class="arrow-up"></span>
        <span class="rect">累计销售额 <?= $user->totalSaleroom ?></span>
        <div class="slice">
            <div class="bar"></div>
            <div class="fill"></div>
        </div>
    </div>

    <div class="am-text-center">
        本月获得推广奖励<span class="orange"><?= $user->thisMonthIncome ?></span>元 <span class="orange op-qrcode">继续推广好友</span>
    </div>
</div>

<div class="page userinfo-line">
    <div class="am-cf">
        <div class="am-u-sm-4">
            <?= Html::img($weixinUser->getAvatarUrl(132), ['class' => 'am-img-thumbnail am-circle', 'style' => "width:80px;float:right;margin-right:15px;"]) ?>
        </div>
        <div class="am-u-sm-4">
            <h2 style="padding-top: 15px;"><?= $user->nickname ?><br/><?= $user->userTypeText ?></h2>
        </div>
        <div class="am-u-sm-4">
            <?php if($user->userType==User::USER_TYPE_NORMAL){ ?>
            <a class="am-fr orange order-link" href="<?= Url::to(['/shop/']) ?>">
                成为代言人
                <i class="am-icon-angle-right am-margin-right"></i>
            </a>
            <?php }else{ ?>
            <a class="am-fr orange order-link" href="<?= Url::to(['/shop/user/order']) ?>">
                我的订单
                <i class="am-icon-angle-right am-margin-right"></i>
            </a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="page extract-line">
    <img src="/img/shop/extract.png" alt=""style="height: 18px; width: auto">
    我的余额（元）<span class="orange"><?= $finance->balance ?></span>
    
    <a class="am-fr" href="<?= Url::to(['/shop/user/extract/create']) ?>">
        提现
        <i class="am-icon-angle-right am-fr am-margin-right"></i>
    </a>
</div>

<div class="page">
    <ul class="am-list" id="user-collapase">
      <li class="am-panel">
        <a data-am-collapse="{target: '#user-nav'}">
            <i class="am-icon-angle-up am-margin-left-sm"></i>
            <i class="am-icon-angle-down am-margin-left-sm"></i>
            累计获得奖励<span class="orange">￥<?= $user->totalIncome ?></span>

            <span class="am-fr fans-number">共<span class="orange"><?= $user->totalLevelNumber ?></span>位粉丝</span>
        </a>
        <ul class="am-list am-list-static am-collapse" id="user-nav">
            <li>直接推广粉丝：<?= $user->level1Number ?>人 <span class="am-fr">推荐奖励(<?= $user->level1Rate*100 ?>%) <?= $user->level1Count ?>元</span></li>

            <?php if($user->userType==User::USER_TYPE_MEMBER || $user->userType==User::USER_TYPE_UNLIMITED){ ?>
            <li>间接推广粉丝：<?= $user->level2Number ?>人 <span class="am-fr">推荐奖励(<?= $user->level2Rate*100 ?>%) <?= $user->level2Count ?>元</span></li>
            <li>次级推广粉丝：<?= $user->level3Number ?>人 <span class="am-fr">推荐奖励(<?= $user->level3Rate*100 ?>%) <?= $user->level3Count ?>元</span></li>
            <?php } ?>
            
            <?php if($user->userType==User::USER_TYPE_UNLIMITED){ ?>
            <li>4级推广粉丝：<?= $user->level4Number ?>人 <span class="am-fr">推荐奖励(<?= $user->level4Rate*100 ?>%) <?= $user->level4Count ?>元</span></li>
            <li>5级推广粉丝：<?= $user->level5Number ?>人 <span class="am-fr">推荐奖励(<?= $user->level5Rate*100 ?>%) <?= $user->level5Count ?>元</span></li>
            <?php } ?>
        </ul>
      </li>
    </ul>
</div>

<?= $this->render('../elements/bottom') ?>
