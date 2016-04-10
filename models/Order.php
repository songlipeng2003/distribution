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

    public static $statuses = [
        self::STATUS_UNPAYNED => '未付款',
        self::STATUS_PAYNED => '已付款',
        self::STATUS_SENDED => '已发货',
        self::STATUS_FINISHED => '已完成'
    ];

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
            'totalAmount' => '总价',
            'status' => '状态',
            'remark' => '备注',
            'createdAt' => '创建时间',
            'payedAt' => '支付时间',
            'updatedAt' => '更新时间',
            'productId' => '产品',
            'quantity' => '数量',
            'provinceId' => '省',
            'cityId' => '市',
            'regionId' => '区',
            'address' => '详细地址',
            'name' => '收货人',
            'phone' => '电话'
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

    public function getProvince()
    {
        return $this->hasOne(Region::className(), ['id' => 'provinceId']);
    }

    public function getCity()
    {
        return $this->hasOne(Region::className(), ['id' => 'cityId']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'regionId']);
    }

    public function getStatusText()
    {
        return self::$statuses[$this->status];
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

            $product->updateCounters(['saledNumber' => 1]);

            return true;
        });
        
        return false;
    }

    public function send()
    {
        return Yii::$app->db->transaction(function() use ($closeType){
            $oldStatus = $this->status;
            
            $this->status = Order::STATUS_SENDED;
            $this->saveAndCheckResult();
            return true;
        });
        
        return false;
    }

    public function finish()
    {
        return Yii::$app->db->transaction(function() use ($closeType){
            $oldStatus = $this->status;
            
            $this->status = Order::STATUS_FINISHED;
            $this->saveAndCheckResult();
            return true;
        });
        
        return false;
    }

    public function finance()
    {
        $user = $this->user;
        $employee = $user->employee;

        if($employee){

        }

        if($user->parent){
            
        }
    }
}
