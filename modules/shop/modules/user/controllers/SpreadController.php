<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;

use app\modules\weixin\models\Weixin;
use app\modules\weixin\models\WeixinUser;

class SpreadController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        $diff = time() - strtotime($user->posterAt);

        if($diff>3600*24){
            $url = $user->genPoster();
        }else{
            $url = $user->poster;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $url = Url::to($url, true);

        $app = Weixin::getApplication();
        $notice = $app->notice;
        $notice->send([
            'touser' => $user->weixin,
            'template_id' => 'wQ3TiFpF4zRAKo4k04aYrym410gbG40t9ndoWRGfoBc',
            'url' => $url,
            'data' => [
                'first' => '您申请办理的业务已经成功',
                'keyword1' => '获取专属二维码海报',
                'keyword2' => date('Y年m月d日'),
                'remark' > '回复“二维码”即可获得当日二维码海报'
            ]
        ]);

        return  [
            'result' => 0,
            'url' => $url
        ];
    }
}
