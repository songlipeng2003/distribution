<?php

namespace app\modules\weixin\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "weixinArticle".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $cover
 * @property string $description
 * @property string $link
 * @property string $content
 * @property string $createdAt
 * @property string $updatedAt
 */
class WeixinArticle extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinArticle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'cover', 'description', 'content'], 'required'],
            ['link', 'url'],
            [['content'], 'string'],
            [['name', 'title', 'cover', 'description', 'link'], 'string', 'max' => 255]
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
            'title' => '标题',
            'cover' => '封面',
            'description' => '描述',
            'link' => '原文链接',
            'content' => '内容',
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
                'value' => function() { return date('Y-m-d H:i:s'); }
            ],
        ];
    }
}
