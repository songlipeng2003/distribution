<?php
namespace app\assets;

use yii\web\AssetBundle;

class AngularAsset extends AssetBundle
{
    public $basePath = '@webroot/lib';

    public $baseUrl = '@web/lib';

    public $css = [
    ];

    public $js = [
        'angular/angular.min.js',
        'angular-sanitize/angular-sanitize.min.js',
        'angular-local-storage/dist/angular-local-storage.min.js',
        'angular-messages/angular-messages.min.js',
        'angular-ui-router/release/angular-ui-router.min.js',
    ];

    public $depends = [
    ];
}
