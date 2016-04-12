<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        return $this->render('index', [
            'user' => $user,
            'weixinUser' => $user->weixinUser,
        ]);
    }
}
