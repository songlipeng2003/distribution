<?php

namespace app\modules\shop\modules\user;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\shop\modules\user\controllers';

    public $layout = '@app/modules/shop/views/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest){
            $action->controller->redirect(['/site/login']);
        }

        return parent::beforeAction($action);
    }
}
