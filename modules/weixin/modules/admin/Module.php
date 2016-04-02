<?php

namespace app\modules\weixin\modules\admin;

class Module extends \app\modules\admin\Module
{
    public $controllerNamespace = 'app\modules\weixin\modules\admin\controllers';

    public $layout = '@app/modules/admin/views/layouts/main';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
