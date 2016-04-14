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
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="extract-page">
    <h2 class="balance"> ￥<?= $finance->balance ?></h2>

    <p>
        因银行接口限制，单词提现1-200元将由微信红包形式即时发送，另每次扣除1元手续费。
    </p>
</div>

<form id="extract_form" class="am-form am-form-horizontal" method="POST">
    <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
    <div class="am-form-group">
        <label class="am-u-sm-4 am-form-label">提现金额：</label>
        <div class="am-u-sm-8">
            <input name="Extract[amount]" type="number" class="am-form-field" placeholder="请输入提现金额(大于5的整数)" required="" min="5" max="200">
        </div>
    </div>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

    <button type="submit" class="am-btn am-btn-primary am-btn-block">立即提现</button>
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