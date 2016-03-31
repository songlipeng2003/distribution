<?php 
use yii\helpers\Html;

$this->title = '个人中心';
?>

<header data-am-widget="header"
      class="am-header am-header-default">
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="user-default-index">
    <div class="am-u-sm-4">
        
    </div>
    <div class="am-u-sm-8">
        <?=Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->username ?>
    </div>
</div>

<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<div >
    合伙人账号：<em>352</em> 
    <a href="am-fr" href="">提现</a>
    此账户为所有可提现金额总和
</div>

<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

<ul class="am-list admin-sidebar-list" id="collapase-nav-1">
  <li class="am-panel">
    <a data-am-collapse="{parent: '#collapase-nav-1', target: '#user-nav'}">
        <i class="am-icon-users am-margin-left-sm"></i>
        推荐分红累计获得：175
        <i class="am-icon-angle-right am-fr am-margin-right"></i>
    </a>
    <ul class="am-list am-collapse admin-sidebar-sub" id="user-nav">
        <li><a href="#/userAdd"><i class="am-icon-user am-margin-left-sm"></i> 添加人员 </a></li>
        <li><a href="#/userList/0"><i class="am-icon-user am-margin-left-sm"></i> 人员列表 </a></li>
    </ul>
  </li>

  <li class="am-panel">
    <a data-am-collapse="{parent: '#collapase-nav-1', target: '#company-nav'}">
        <i class="am-icon-table am-margin-left-sm"></i>
        每日红包累计获得：175
        <i class="am-icon-angle-right am-fr am-margin-right"></i>
    </a>
    <ul class="am-list am-collapse admin-sidebar-sub" id="company-nav">
        <li><a href="#/companyAdd"><span class="am-icon-table am-margin-left-sm"></span> 添加单位（部门） </a></li>
        <li><a href="#/companyList/0"><span class="am-icon-table am-margin-left-sm"></span> 单位（部门）列表 </a></li>
    </ul>
  </li>
</ul>

分红完成度：11% 总计1999元分红
<div class="am-progress am-progress-xs">
    <div class="am-progress-bar" style="width: 80%"></div>
</div>
累计获得：19221.00元 剩余可获得 11100.00元

<?= $this->render('../elements/bottom') ?>
