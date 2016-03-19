<?php

namespace app\modules\weixin\models;

use Yii;

/**
 * This is the model class for table "weixinMenu".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $parentId
 * @property string $key
 * @property string $url
 * @property string $createdAt
 * @property string $updatedAt
 */
class WeixinMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinMenu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'type', 'key', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'parentId' => 'Parent ID',
            'key' => 'Key',
            'url' => 'Url',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
