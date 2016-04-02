<?php

namespace app\modules\weixin\models;

use Yii;

use EasyWeChat\Foundation\Application;

class Weixin 
{
    private static $application;

    public static function getApplication()
    {
        if(!self::$application){
            $options = [
                'debug'  => $_ENV['WEIXIN_DEBUG'],
                'app_id' => $_ENV['WEIXIN_APP_ID'],
                'secret' => $_ENV['WEIXIN_SECRET'],
                'token'  => $_ENV['WEIXIN_TOKEN'],
                // 'aes_key' => null, // 可选

                'log' => [
                    'level' => 'debug',
                    'file'  => Yii::$app->basePath . '/runtime/logs/weixin.log',
                ],
                'oauth' => [
                    'scopes'   => ['snsapi_userinfo'],
                    'callback' => '/weixin/auth/callback',
                ],

                // /**
                //  * 微信支付
                //  */
                // 'payment' => [
                //     'merchant_id'        => 'your-mch-id',
                //     'key'                => 'key-for-signature',
                //     'cert_path'          => Yii::$app->basePath . '/config/weixin/cert.pem', // XXX: 绝对路径！！！！
                //     'key_path'           => Yii::$app->basePath . '/config/weixin/key',      // XXX: 绝对路径！！！！
                //     // 'device_info'     => '013467007045764',
                //     // 'sub_app_id'      => '',
                //     // 'sub_merchant_id' => '',
                //     // ...
                // ],
            ];

            self::$application = new Application($options);
        }

        return self::$application;
    }

    public function sendTemplateMessage($templateId, $openid, $data, $url = null, $topColor = null)
    {
        $app = self::getApplication();
        $notice = $app->notice;
        $template = $notice->template($templateId)->to($openid)->data($data);
        if($url){
            $template = $template->url($url);
        }
        if($topColor){
            $template = $template->color($topColor);
        }

        return $template->send();
    }

    public static function messageHandler(){
        $app = Weixin::getApplication();
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            $openid = $message->FromUserName;
            $weixinUser = WeixinUser::findOne(['openid' => $openid]);
            if($weixinUser){
                $weixinUser->lastMessageAt = date('Y-m-d H:m:i');
                $weixinUser->save();
            }

            switch ($message->MsgType) {
                case 'event':
                    $openid = $message->from;
                    switch ($message->Event) {
                        case 'subscribe':
                            return WeixinRule::handleSubscribe($message);
                            break;
                        case 'unsubscribe':
                            # code...
                            break;
                        case 'SCAN':
                            # code...
                            break;
                        case 'LOCATION':
                            # code...
                            break;
                        case 'CLICK':
                            # code...
                            break;
                        case 'VIEW':
                            # code...
                            break;

                        default:
                            # code...
                            break;
                    }
                    break;
                case 'text':
                    $content = $message->Content;

                    $weixinMessage = new WeixinMessage;
                    $weixinMessage->content = $content;
                    $weixinMessage->openid = $openid;
                    $weixinMessage->type = WeixinMessage::TYPE_RECEIVE;
                    $weixinMessage->isReplay = false;
                    $weixinMessage->save();

                    return WeixinRule::handleRule($content);
                    break;
                case 'image':
                    # 图片消息...
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                // ... 其它消息
                default:
                    return WeixinRule::handleDefault();
                    break;
            }
        });

        $app->server->serve()->send();
    }
}