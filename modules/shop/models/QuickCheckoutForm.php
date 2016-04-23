<?php
namespace app\modules\shop\models;

use Yii;
use yii\base\Model;

use app\models\Admin;
use app\models\Order;
use app\models\Product;

class QuickCheckoutForm extends Model
{
    public $productId;
    public $quantity;
    public $provinceId;
    public $cityId;
    public $regionId;
    public $address;
    public $name;
    public $phone;
    public $remark;

    public $order;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'quantity', 'provinceId', 'cityId', 'regionId', 'address', 'name', 'phone'], 'required'],
            [['quantity'], 'number', 'min' => 1],
            ['quantity', function($attribute, $params){
                if($this->productId){
                    $product = Product::findOne($this->productId);
                    if($product && $product->quantity < $this->quantity){
                        $this->addError('quantity', '库存数量不足');
                    }
                }
            }],
            ['phone', 'string', 'length' => 11],
            ['remark', 'string', 'max' => 255],
            ['address', 'string', 'min' => 5, 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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

    public function checkout()
    {
        if($this->validate()){
            $order = new Order;
            $order->userId = Yii::$app->user->id;
            $order->load(['Order' => $this->getAttributes()]);
            $order->status = Order::STATUS_UNPAYED;
            if($order->save()){
                $this->order = $order;

                return true;
            }
        }

        return false;
    }
}