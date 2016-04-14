<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '合伙人账户';
?>

<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="<?= Url::to(['/shop/user/']) ?>">
            <i class="am-icon-chevron-left" ></i>
        </a>
    </div>
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div>
    <h2>合伙人账户</h2>

    <em>352.00</em>

    <p>
        因银行接口限制，单词提现1-200元将由微信红包形式即时发送，另每次扣除1元手续费。
    </p>
</div>


<form class="am-form am-form-horizontal">
    <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">提现金额：</label>
        <div class="am-u-sm-8">
            <input type="amount" placeholder="请输入大于5的整数">
        </div>
    </div>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

    <button type="submit" class="am-btn am-btn-primary am-btn-block">立即提现</button>
</form>

<?= $this->render('../elements/bottom') ?>