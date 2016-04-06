<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => '后台管理',
            'brandUrl' => ['/admin/default/index'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-pull nav-pills'],
            #修改使用yii2-admin的菜单控制项
            'items' => [
                ['label' => '产品管理', 'url' => ['/admin/product/index']],
                ['label' => '订单管理', 'url' => ['/admin/order/index']],
                ['label' => '公告管理', 'url' => ['/admin/notice/index']],
                ['label' => '员工管理', 'url' => ['/admin/employee/index']],
                ['label' => '提现管理', 'url' => ['/admin/extract/index']],
                ['label' => '区域管理', 'url' => ['/admin/region/index']],
                [
                    'label' => '微信管理', 
                    'url' => '#',
                    'items' => [
                        ['label' => '微信菜单管理', 'url' => ['/weixin/admin/menu/index']],
                        ['label' => '微信用户管理', 'url' => ['/weixin/admin/weixin-user/index']],
                        ['label' => '微信用户群组管理', 'url' => ['/weixin/admin/weixin-group/index']],
                        ['label' => '微信文章管理', 'url' => ['/weixin/admin/weixin-article/index']],
                        ['label' => '微信规则管理', 'url' => ['/weixin/admin/weixin-rule/index']],
                        ['label' => '微信消息记录管理', 'url' => ['/weixin/admin/weixin-message/index']]
                    ]
                ]
            ],
        ]);

        if (Yii::$app->admin->isGuest) {
            $menuItems[] = ['label' => '登录', 'url' => ['/admin/account/login']];
        } else {
            $menuItems[] = [
                'label' => '注销 (' . Yii::$app->admin->identity->username . ')',
                'url' => ['/admin/account/logout'],
                'linkOptions' => ['data-method' => 'post'],
            ];
            $menuItems[] = ['label' => '修改密码', 'url' => ['/admin/account/change-password']];
        }
        
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav pull-right'],
            'items' => $menuItems,
        ]);

        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => '首页', 'url' => ['/admin/']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            $key = $key == 'error' ? 'danger' : $key;
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 安徽华米信息科技有限公司 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
