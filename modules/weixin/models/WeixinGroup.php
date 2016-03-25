<?php

namespace app\modules\weixin\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "weixinGroup".
 *
 * @property integer $id
 * @property string $name
 * @property string $count
 * @property string $createdAt
 * @property string $updatedAt
 */
class WeixinGroup extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinGroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'name' => '名称',
            'count' => '用户数量',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }

    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'createdAt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updatedAt',
                ],
                'value' => function() { return date('Y-m-d H:m:i'); }
            ],
        ];
    }

    public static function sync()
    {
        $group = Weixin::getApplication()->user_group;

        $groups = $group->lists();

        WeixinGroup::deleteAll();

        foreach($groups->groups as $g){
            $weixinGroup = new WeixinGroup();
            $weixinGroup->id = $g['id'];
            $weixinGroup->name = $g['name'];
            $weixinGroup->count = $g['count'];
            $weixinGroup->save();
        }
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if(!$this->id){
                $group = Weixin::getApplication()->user_group;

                $result = $group->create($this->name);
                $this->id = $result->group['id'];
            }

            return true;
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $group = Weixin::getApplication()->user_group;
        if($insert){
        }else{
            $group->update($this->id, $this->name);
        }
    }

    public function afterDelete()
    {
        $group = Weixin::getApplication()->user_group;
        $group->delete($this->id);
    }

    public function addUser($openid)
    {
        $group = Weixin::getApplication()->user_group;
        $group->moveUser($openid, $this->id);
    }

    public function addUsers($openids)
    {
        $group = Weixin::getApplication()->user_group;
        $group->moveUsers($openids, $this->id);
    }
}
