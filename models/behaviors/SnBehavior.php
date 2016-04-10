<?php

namespace app\models\behaviors;

use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

class SnBehavior extends AttributeBehavior
{
    public $attribute = 'sn';

    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->attribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => [],
            ];
        }
    }

    public function getValue($event)
    {
        $sn = date('ymdh').rand(1000, 9999);

        $count = $this->owner->find()->where(['sn'=>$sn])->count();
        if($count>0){
            $sn = $this->getValue($event);
        }

        return $sn;
    }
}
