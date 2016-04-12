<?php

namespace app\models;

use Yii;

use yii\helpers\ArrayHelper;

use yii\behaviors\TimestampBehavior;

use app\models\behaviors\SnBehavior;

/**
 * This is the model class for table "tradingRecord".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $userType
 * @property integer $tradingType
 * @property string $name
 * @property string $amount
 * @property string $startAmount
 * @property string $endAmount
 * @property string $itemType
 * @property integer $itemId
 * @property string $remark
 * @property string $createdAt
 */
class TradingRecord extends BaseModel
{
    const TRADING_RECORD_INCOME = 1;

    const TRADING_RECORD_EXPENSE = 2;

    const ITEM_TYPE_ORDER = 'order';

    public $tradingTypes = [
        self::TRADING_RECORD_INCOME => '收入',
        self::TRADING_RECORD_EXPENSE => '支出',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tradingRecord';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'userType', 'tradingType', 'itemId'], 'integer'],
            [['startAmount', 'endAmount', 'amount'], 'number'],
            [['name', 'itemType', 'remark'], 'string', 'max' => 255]
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
            'userType' => '用户类型',
            'tradingType' => '交易类型',
            'name' => '名称',
            'amount' => '金额',
            'startAmount' => '开始资金',
            'endAmount' => '结束资金',
            'itemType' => '物品类型',
            'itemId' => '物品编号',
            'remark' => '备注',
            'createdAt' => '交易时间',
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => null,
                'value' => function(){ return date('Y-m-d H:i:s'); },
            ],
            [
                'class' => SnBehavior::className()
            ]
        ]);
    }

    public function getTradingTypeName()
    {
        return self::$tradingTypes[$this->tradingType];
    }
    
    public function fields()
    {
        return [
            'id',
            'sn',
            'tradingType',
            'tradingTypeName',
            'amount',
            'name',
            'startAmount',
            'endAmount',
            'createdAt',
            'remark',
        ];  
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId'])->one();
    }

    public function getFinance()
    {
        return Finance::getByUser($this->userType, $this->userId);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert){
                $this->startAmount = $this->finance->balance;
                $this->endAmount = $this->finance->balance + $this->amount;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            $finance = $this->finance;
            $finance->balance = $this->endAmount;

            $finance->saveAndCheckResult();
        }
    }
}
