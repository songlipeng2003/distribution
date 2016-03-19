<?php

namespace app\modules\weixin\models;

use Yii;

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
class WeixinArticle extends \yii\db\ActiveRecord
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
            [['content'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'title', 'cover', 'description', 'link'], 'string', 'max' => 255]
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
            'title' => 'Title',
            'cover' => 'Cover',
            'description' => 'Description',
            'link' => 'Link',
            'content' => 'Content',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
