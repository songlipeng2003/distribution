<?php

namespace app\modules\shop\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\shop\modules\admin\controllers';

    public $layout = '@app/modules/admin/views/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
