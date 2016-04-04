<?php
namespace app\assets;

use yii\web\AssetBundle;

class EmployeeAsset extends AssetBundle
{
    public $basePath = '@webroot/';

    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/employee/app.js',
    ];

    public $depends = [
        'app\assets\IonicAsset',
    ];
}
