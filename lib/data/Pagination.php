<?php
namespace app\lib\data;
class Pagination extends \yii\data\Pagination
{
    public $validatePage = false;

    public $defaultPageSize = 10;
}