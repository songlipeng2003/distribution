<?php

namespace app\modules\weixin\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "weixinMessage".
 *
 * @property integer $id
 * @property string $openid
 * @property string $content
 * @property integer $type
 * @property integer $isReplay
 * @property string $createdAt
 */
class WeixinMessage extends ActiveRecord
{
    const TYPE_RECEIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinMessage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'isReplay'], 'integer'],
            [['openid', 'content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'openid' => 'Openid',
            'content' => '内容',
            'type' => '类型',
            'isReplay' => '是否恢复',
            'createdAt' => '创建时间',
        ];
    }

    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'createdAt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => null,
                ],
                'value' => function() { return date('Y-m-d H:m:i'); }
            ],
        ];
    }
}
