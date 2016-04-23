<?php 

namespace app\modules\admin\models;

use Yii;

class System
{
    public static function loadAllParams()
    {
        return [
            'phpVersion' => phpversion(),
            'system' => php_uname(),
            'server' => $_SERVER['SERVER_SOFTWARE'],
            'mysql' => Yii::$app->db->createCommand('SELECT VERSION()')->queryScalar(),

            'authors' => '',
        ];
    }
}