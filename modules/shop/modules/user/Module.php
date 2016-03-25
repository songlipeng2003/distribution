<?php

namespace app\modules\shop\modules\user;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\shop\modules\user\controllers';

    public $layout = '@app/modules/shop/views/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
