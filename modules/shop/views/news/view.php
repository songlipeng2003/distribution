<?php
use app\modules\weixin\models\Weixin;

$js = Weixin::getApplication()->js;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=0">
    <title><?= Yii::$app->settings->get('system', 'weixinName') ?></title>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        wx.config(<?php echo $js->config(['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo'], false) ?>);
        wx.onMenuShareTimeline({
            title: '<?= $model->title ?>'
        });
        wx.onMenuShareAppMessage({
            title: '<?= $model->title ?>'
        });
        wx.onMenuShareQQ({
            title: '<?= $model->title ?>'
        });
        wx.onMenuShareWeibo({
            title: '<?= $model->title ?>'
        });
    </script>
    <style type="text/css" media="screen">
        body {
            max-width: 740px;
            margin: 20px auto;
        }
        .page {
            padding: 0 15px 15px;
        }
        h1{
            margin-bottom: 10px;
            font-size: 24px;
        }
        .info {
            margin-bottom: 18px;
            word-wrap: break-word;
        }
        .date, .author {
            color: #8c8c8c;
            font-size: 16px;
            display: inline-block;
            margin-right: 8px;
            margin-bottom: 10px;
        }
        .info a {
            color: #607fa6;
            font-size: 16px;
        }
        .content {
            word-wrap: break-word;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="page">
        <h1><?= $model->title ?></h1>
        <div class="info">
            <span class="date"><?= substr($model->createdAt, 0, 10) ?></span>
            <span class="author"><?= $model->author ?></span>
            <a><?= Yii::$app->settings->get('system', 'weixinName') ?></a>
        </div>
        <div class="content">
            <?= $model->content ?>
        </div>
    </div>
</body>
</html>