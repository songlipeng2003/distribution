<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $provinceId
 * @property integer $cityId
 * @property integer $regionId
 * @property string $address
 * @property string $name
 * @property string $phone
 * @property string $createdAt
 * @property string $updatedAt
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'provinceId', 'cityId', 'regionId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['address', 'name', 'phone'], 'string', 'max' => 255]
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
            'provinceId' => '省',
            'cityId' => '市',
            'regionId' => '区',
            'address' => '详细地址',
            'name' => '名称',
            'phone' => '电话',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }

    public function behaviors()
    {
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
