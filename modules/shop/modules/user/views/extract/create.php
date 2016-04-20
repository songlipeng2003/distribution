<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->title = '合伙人账户';
?>

<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="<?= Url::to(['/shop/user/']) ?>">
            <i class="am-icon-chevron-left" ></i>
        </a>
    </div>
    <div class="am-header-right am-header-nav">
        <a href="<?= Url::to(['/shop/user/extract']) ?>">
            提现记录
        </a>
    </div>
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<form id="extract_form" class="am-form am-form-horizontal" method="POST">
<div class="panel extract-page">
    <div class="title">
        提现方式 &nbsp;&nbsp;&nbsp;&nbsp;<span>微信红包</span>
    </div>
    <div class="content">
        <h3>提现金额</h3>
        <span style="font-size: 20px;">￥</span>
        <input name="Extract[amount]" type="number" class="am-form-field" required="" min="5" max="200">
        <h3>代言人余额 ￥<?= $finance->balance ?></h3>
        <p>
            * 因微信提现限制，所有提现均以微信红包形式即时发放，每   次提现金额为5-200元，可多次提现，单次提现扣除1元手续费。
        </p>
    </div>
</div>

<h3 style="text-align: center;">即时到账</h3>

<button type="submit" class="am-btn am-btn-primary am-btn-block">提现</button>

</form>

<?= $this->render('../elements/bottom') ?>

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
$this->registerJsFile('/js/shop/extract.js', ['depends' => [
    JqueryAsset::className(),
]]);
?>