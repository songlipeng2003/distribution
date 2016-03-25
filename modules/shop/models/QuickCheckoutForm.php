<?php
namespace app\modules\shop\models;

use Yii;
use yii\base\Model;

use app\models\Admin;

class QuickCheckoutForm extends Model
{
    public $productId;
    public $quantity;
    public $provinceId;
    public $cityId;
    public $regionId;
    public $address;
    public $name;
    public $phone
    public $remark;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'quantity', 'provinceId', 'cityId', 'regionId', 'address', 'name', 'phone'], 'required'],
            [['quantity'], 'number', 'min' => 1],
            ['phone', 'string', 'length' => 11],
            ['remark', 'string', 'max' => 255],
            ['address', 'string', 'min' => 3, 'max' => 30]
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
    }
}