<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "extract".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $amount
 * @property integer $toAmount
 * @property string $createdAt
 * @property string $operatedAt
 */
class Extract extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'extract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'amount', 'toAmount'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'userId' => '用户',
            'amount' => '金额',
            'toAmount' => '到账金额',
            'createdAt' => '创建时间',
            'operatedAt' => '操作时间',
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
