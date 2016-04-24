<?php
namespace app\modules\weixin\models;

class WeixinTemplateMessage
{
    public static function send($openid, $templateId, $data, $url = null)
    {
        $app = Weixin::getApplication();
        $notice = $app->notice;
        $notice->send([
            'touser' => $openid,
            'template_id' => $templateId,
            'data' => $data,
            'url' => $url
        ]);
    }
}