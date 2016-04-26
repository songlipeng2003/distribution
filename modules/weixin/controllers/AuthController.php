<?php

namespace app\modules\weixin\controllers;

use Yii;

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
            $oauth->redirect()->send();
        }else{
            return $this->redirect("/shop/");
        }
    }

    public function actionCallback()
    {
        $app = Weixin::getApplication();
        $oauth = $app->oauth;
        $oauthUser = $oauth->user();
        if($oauthUser){
            $openid = $oauthUser->getId();
            $weixinUser = WeixinUser::findOne(['openid' => $openid]);
            if(!$weixinUser){
                $weixinUser = new WeixinUser([
                    'openid' => $oauthUser->getId(),
                    'nickname' => $oauthUser->getNickname(),
                    'avatar' => $oauthUser->getAvatar(),
                ]);
            }else{
                $weixinUser->nickname = $oauthUser->getNickname();
                $weixinUser->avatar = $oauthUser->getAvatar();
            }

            if($weixinUser->save()){
                $user = User::findOne(['weixin' => $openid]);
                if(!$user){
                    $user = new User();
                    $user->weixin = $openid;
                    $user->nickname = $oauthUser->getNickname();
                    $user->avatar = $oauthUser->getAvatar();
                    $user->save();
                }else{
                    $user->lastLoginedAt = date('Y-m-d H:i:s');
                    $user->save();
                }

                Yii::$app->user->login($user, 0);

                $this->redirect("/shop/");
            }else{
                throw new Exception("save user error");
            }
        }
    }
}
