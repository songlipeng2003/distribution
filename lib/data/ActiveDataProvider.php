<?php
namespace app\lib\data;
class ActiveDataProvider extends \yii\data\ActiveDataProvider
{
    public function init()
    {
        parent::init();
        $pagination = $this->getPagination();
        if(!$pagination instanceof Pagination){
            $this->setPagination(new Pagination());
        }
    }
}