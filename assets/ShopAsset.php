<?php

namespace app\assets;

use yii\web\AssetBundle;

class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    
    public $baseUrl = '@web';

    public $css = [
        'css/shop.css',
        'css/circle.css',
    ];

    public $js = [
        'js/shop/shop.js',
    ];

    public $depends = [
        'app\assets\AmazeUIAsset',
    ];
}
