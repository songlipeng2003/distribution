<?php

namespace app\modules\admin;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $layout = 'main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        if(Yii::$app->admin->isGuest && $action->id!='login'){
            $action->controller->redirect(array('account/login'));
        }

        return parent::beforeAction($action);
    }
}
