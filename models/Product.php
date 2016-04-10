<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use rico\yii2images\behaviors\ImageBehave;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $price
 * @property integer $quantity
 * @property integer $saledNumber
 * @property integer $status
 * @property string $content
 * @property string $createdAt
 * @property string $updatedAt
 */
class Product extends BaseModel
{
    public $files;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'quantity'], 'required'],
            [['price', 'originalPrice'], 'number', 'min' => 1],
            [['quantity', 'status'], 'integer'],
            [['content'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
            ['files', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'name' => '名称',
            'image' => '图片',
            'originalPrice' => '原价',
            'price' => '价格',
            'quantity' => '数量',
            'saledNumber' => '销售数量',
            'status' => '状态',
            'content' => '内容',
            'createdAt' => '创建时间',
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
            'image' => [
                'class' => ImageBehave::className(),
            ]
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->files){
            foreach($this->files as $file){
                $this->attachImage(Yii::getAlias("@webroot") . $file);
            }
        }
    }
}
