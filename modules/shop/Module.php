<?php

namespace app\modules\shop;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\shop\controllers';

    public function init()
    {
        parent::init();

        $this->modules = [
            'admin' => [
                'class' => 'app\modules\shop\modules\admin\Module',
            ],
        ];
    }
}
