<?php

namespace app\modules\weixin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\weixin\controllers';

    public function init()
    {
        parent::init();

        $this->modules = [
            'admin' => [
                'class' => 'app\modules\weixin\modules\admin\Module',
            ],
        ];
    }
}
