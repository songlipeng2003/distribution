<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '提现成功';
?>
<div class="page success-page">
    
    <img src="/img/shop/extract-success.jpg" alt="" style="width: 50%">

    <p>
        你已经提现成功，请返回公众号领取红包，您也可继续提现
    </p>
    <hr>

    <a class="am-btn am-btn-primary" href="<?= Url::to(['/shop/user/extract/create']) ?>">继续提现</a>
</div>