<?php

namespace app\modules\shop\modules\user;

use Yii;

class Module extends \app\modules\user\Module
{
    public $controllerNamespace = 'app\modules\shop\modules\user\controllers';

    public $layout = '@app/modules/shop/views/layouts/main';

    public function init()
    {
        parent::init();
    }
}
