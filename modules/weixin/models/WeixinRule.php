<?php

namespace app\modules\weixin\models;

use Yii;

/**
 * This is the model class for table "weixinRule".
 *
 * @property integer $id
 * @property string $keyword
 * @property integer $weixinArticle
 * @property string $createdAt
 */
class WeixinRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinRule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weixinArticle'], 'integer'],
            [['createdAt'], 'safe'],
            [['keyword'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Keyword',
            'weixinArticle' => 'Weixin Article',
            'createdAt' => 'Created At',
        ];
    }
}
