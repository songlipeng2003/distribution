<?php

namespace app\modules\shop;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\shop\controllers';

    public $layout = 'main';

    public function init()
    {
        parent::init();

        $this->modules = [
            'user' => [
                'class' => 'app\modules\shop\modules\user\Module',
            ],
            'admin' => [
                'class' => 'app\modules\shop\modules\admin\Module',
            ],
        ];
    }
}
