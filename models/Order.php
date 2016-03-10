<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $productId
 * @property integer $quantity
 * @property string $price
 * @property string $total_amount
 * @property integer $status
 * @property string $remark
 * @property string $createdAt
 * @property string $payedAt
 * @property string $updatedAt
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['remark'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'productId' => '产品',
            'quantity' => '数量',
            'price' => '价格',
            'total_amount' => '总价',
            'status' => '状态',
            'remark' => '被逐',
            'createdAt' => '创建时间',
            'payedAt' => '支付时间',
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
}
