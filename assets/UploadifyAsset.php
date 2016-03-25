<?php
namespace app\assets;

use yii\web\AssetBundle;

class UploadifyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    
    public $css = [
        'css/uploadify.css',
    ];

    public $js = [
        'js/jquery.uploadify.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
