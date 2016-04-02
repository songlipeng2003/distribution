<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;

use app\modules\weixin\models\WeixinUser;

class SpreadController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $weixinUser = $user->weixinUser;
        return $this->render('index', [
            'url' => $weixinUser->spreadUrl
        ]);
    }
}
