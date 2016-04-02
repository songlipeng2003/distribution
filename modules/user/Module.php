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
                $action->controller->redirect(['/site/login']);
            }
            
            return true;
        }

        return false;
    }
}
