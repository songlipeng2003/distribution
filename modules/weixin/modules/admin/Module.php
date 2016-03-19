<?php

namespace app\modules\weixin\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\weixin\modules\admin\controllers';

    public $layout = '@app/modules/admin/views/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
