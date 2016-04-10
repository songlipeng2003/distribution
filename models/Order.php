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
 * @property string $totalAmount
 * @property integer $status
 * @property string $remark
 * @property string $createdAt
 * @property string $payedAt
 * @property string $updatedAt
 */
class Order extends BaseModel
{
    const STATUS_UNPAYNED = 10;
    const STATUS_PAYNED = 20;
    const STATUS_SENDED = 30;
    const STATUS_FINISHED = 40;

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
            [['productId', 'quantity', 'provinceId', 'cityId', 'regionId', 'address', 'name', 'phone'], 'required'],
            [['productId', 'quantity', 'provinceId', 'cityId', 'regionId'], 'integer', 'min' => 1],
            [['price'], 'number'],
            ['address', 'string', 'min' => 3, 'max' => 30],
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

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => function() { return date('Y-m-d H:i:s'); }
            ],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->price = $this->product->price;

                $this->totalAmount = $this->price * $this->quantity;
            }

            return true;
        }

        return false;
    }

    public function pay()
    {
        return Yii::$app->db->transaction(function() use ($closeType){
            $oldStatus = $this->status;
            
            $this->status = Order::STATUS_PAYNED;
            $this->saveAndCheckResult();
            return true;
        });
        
        return false;
    }
}
