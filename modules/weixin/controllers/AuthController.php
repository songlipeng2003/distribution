<?php

namespace app\modules\weixin\controllers;

use yii\web\Controller;

use app\models\User;
use app\modules\weixin\models\Weixin;
use app\modules\weixin\models\WeixinUser;

class AuthController extends Controller 
{
    public function actionLogin()
    {
        $app = Weixin::getApplication();
        $oauth = $app->oauth;
        if(Yii::$app->user->isGuest){
            return $oauth->redirect();
        }
    }

    public function actionCallback()
    {
        $app = Weixin::getApplication();
        $oauth = $app->oauth;
        $oauthUser = $oauth->user();
        if($user){
            $weixinUser = new WeixinUser({
                'openid' => $oauthUser->getId(),
                'nickname' => $oauthUser->getNickname(),
                'avatar' => $oauthUser->getAvatar(),
            });
            $weixinUser->save();

            // $token = $user->getToken();
            // $user = User::findOne(['weixin' => $token]);
            // if(!$user){
            //     $user = new User();
            //     $user->weixin = $token;
            //     $user->save();
            // }else{
            //     $user->lastLoginedAt = date('Y-m-d H:i:s');
            //     $user->save();
            // }

            // Yii::$app->user->login($user, 0);

            $this->redirect("/shop/");
        }
    }
}
