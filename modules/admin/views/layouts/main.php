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
                // ['label' => '新闻管理', 'url' => ['/admin/news/index']]
            ],
        ]);

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => '注销 (' . Yii::$app->user->identity->name . ')',
                'url' => ['/site/logout'],
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
