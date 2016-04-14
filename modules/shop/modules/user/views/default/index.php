<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '个人中心';
?>

<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="user-index am-cf">
    <div class="am-u-sm-4">
        <?= Html::img($weixinUser->getAvatarUrl(132)) ?>
    </div>
    <div class="am-u-sm-8">
        <h2><?= $user->username ?></h2>
    </div>
</div>

<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<div class="">
    <h2>合伙人账号：<em class="price">￥<?= $finance->balance ?></em>
    <a class="am-fr am-text-xl" href="<?= Url::to(['/shop/user/extract/create']) ?>">提现</a></h2>
    此账户为所有可提现金额总和
</div>

<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<ul class="am-list admin-sidebar-list" id="collapase-nav-1">
  <li class="am-panel">
    <a data-am-collapse="{parent: '#collapase-nav-1', target: '#user-nav'}">
        <i class="am-icon-users am-margin-left-sm"></i>
        推荐分红累计获得：<?= $user->totalIncome ?>
        <i class="am-icon-angle-right am-fr am-margin-right"></i>
    </a>
    <ul class="am-list am-list-static am-collapse admin-sidebar-sub" id="user-nav">
        <li>直接推广：<?= $user->level1Number ?>人 获取分红(10%) 100元</li>
        <li>间接推广：<?= $user->level2Number ?>人 获取分红(10%) 100元</li>
        <li>次级推广：<?= $user->level3Number ?>人 获取分红(10%) 100元</li>
    </ul>
  </li>
</ul>

分红完成度 <?= $user->getThisMonthRate() ?>% 总计<?= $user->monthLimit ?>元分红
<div class="am-progress am-progress-xs">
    <div class="am-progress-bar" style="width: <?= $user->getThisMonthRate() ?>%"></div>
</div>
累计获得：<?= $user->totalIncome ?>元 剩余可获得 <?= $user->monthLimit - $user->getThisMonthRate() ?>元

<?= $this->render('../elements/bottom') ?>
