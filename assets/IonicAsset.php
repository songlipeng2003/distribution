<?php
namespace app\assets;

use yii\web\AssetBundle;

class IonicAsset extends AssetBundle
{
    public $basePath = '@webroot/lib';

    public $baseUrl = '@web/lib';

    public $css = [
        'ionic/release/css/ionic.min.css',
    ];

    public $js = [
        'ionic/release/js/ionic.min.js',
        'ionic/release/js/ionic-angular.min.js',
        'ionic/release/js/ionic.bundle.min.js',
    ];

    public $depends = [
        'app\assets\AngularAsset',
    ];
}
