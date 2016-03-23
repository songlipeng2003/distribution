<?php

namespace app\assets;

use yii\web\AssetBundle;

class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    
    public $baseUrl = '@web';

    public $css = [
        'css/shop.css',
    ];

    public $js = [
    ];

    public $depends = [
        'app\assets\AmazeUIAsset',
    ];
}
