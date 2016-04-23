<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->title = '提现记录';
?>

<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a href="<?= Url::to(['/shop/user/extract/create']) ?>">
            <i class="am-icon-chevron-left" ></i>
        </a>
    </div>
  <h1 class="am-header-title"><?= Html::encode($this->title) ?></h1>
</header>

<div class="am-panel-group">
<?php foreach ($dataProvider->getModels() as $key => $extract): ?>
    <div class="am-panel am-panel-default">
        <div class="am-panel-bd">
            提现金额：<?= $extract->amount ?><br/>
            提现时间：<?= $extract->createdAt ?> 
        </div>
    </div>
<?php endforeach ?>
</div>