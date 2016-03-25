<?php

namespace app\modules\weixin\controllers;

use yii\web\Controller;

use EasyWeChat\Foundation\Application;

use app\models\Weixin;

class WeixinController extends Controller
{
    public function actionIndex()
    {
        $app = Weixin::getApplication();

        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    break;
                case 'text':
                    # 文字消息...
                    break;
                case 'image':
                    # 图片消息...
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }
        });

        $app->server->serve()->send();
    }
}
