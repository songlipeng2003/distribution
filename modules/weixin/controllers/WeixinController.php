<?php

namespace app\modules\weixin\controllers;

use yii\web\Controller;

use EasyWeChat\Foundation\Application;

use app\modules\weixin\models\Weixin;

class WeixinController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        Weixin::messageHandler();
    }
}
