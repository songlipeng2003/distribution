<?php 
namespace app\assets;

use yii\web\AssetBundle;

class UnderscoreAsset extends AssetBundle
{
    public $sourcePath = '@npm/underscore/';

    public $js = [
        'underscore-min.js'
    ];
}