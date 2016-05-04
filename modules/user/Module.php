<?php

namespace app\modules\user;

use Yii;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'app\modules\user\controllers';

    public function beforeAction($action)
    {
        if(parent::beforeAction($action)){
            if(Yii::$app->user->isGuest){
                $url = Yii::$app->request->url;
                Yii::$app->session->set('currentUrl', $url);

                $action->controller->redirect(['/site/login']);
                return false;
            }
            
            return true;
        }

        return false;
    }
}
