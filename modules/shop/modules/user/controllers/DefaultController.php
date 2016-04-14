<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;

use app\models\Finance;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        $finance = Finance::getByUser(Finance::USER_TYPE_USER, $user->id);
        return $this->render('index', [
            'user' => $user,
            'finance' => $finance,
            'weixinUser' => $user->weixinUser,
        ]);
    }
}
