<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=0">
    <title><?= Yii::$app->settings->get('system', 'weixinName') ?></title>
    <style type="text/css" media="screen">
        body {
            max-width: 740px;
            margin: 20px auto;
        }
        h1{
            padding-bottom: 10px;
            margin-bottom: 14px;
            border-bottom: 1px solid #e7e7eb;
        }
        .info {
            margin-bottom: 18px;
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
    </style>
</head>
<body>
    <h1><?= $model->title ?></h1>
    <div class="info">
        <span class="date"><?= substr($model->createdAt, 0, 10) ?></span>
        <span class="author"><?= $model->author ?></span>
        <a><?= Yii::$app->settings->get('system', 'weixinName') ?></a>
    </div>
    <div>
        <?= $model->content ?>
    </div>
</body>
</html>