<?php
namespace app\assets;

use yii\web\AssetBundle;

class AmazeUIAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/amazeui/dist';
    
    public $css = [
        'css/amazeui.min.css',
    ];

    public $js = [
        'js/amazeui.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
