<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use app\models\behaviors\SnBehavior;
use app\modules\weixin\models\WeixinTemplateMessage;

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
    const STATUS_UNPAYED = 10;
    const STATUS_PAYED = 20;
    const STATUS_SENDED = 30;
    const STATUS_FINISHED = 40;

    const SCENARIO_SEND = 'send';

    const EXPRESS_YUNDA = 1;

    public static $statuses = [
        self::STATUS_UNPAYED => '未付款',
        self::STATUS_PAYED => '已付款',
        self::STATUS_SENDED => '已发货',
        self::STATUS_FINISHED => '已完成'
    ];

    public static $expresses = [
        self::EXPRESS_YUNDA => '韵达'
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
            [['remark'], 'string', 'max' => 255],

            [['expressId', 'expressSn'], 'required', 'on' => self::SCENARIO_SEND]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'sn' => '订单号',
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
            'phone' => '电话',
            'expressId' => '快递公司',
            'expressSn' => '快递单号',
            'sendedAt' => '发货时间'
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
            [
                'class' => SnBehavior::className(),
                'value' => function(){
                    $sn = date('ymdh').rand(10, 99);
                    $count = self::find()->where(['sn'=>$sn])->count();
                    if($count>0){
                        $sn = $this->getValue($event);
                    }

                    return $sn;
                }
            ]
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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getStatusText()
    {
        return self::$statuses[$this->status];
    }

    public function getExpressName()
    {
        return self::$expresses[$this->expressId];
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

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            $this->product->updateCounters([
                'saledNumber' => $this->quantity,
                'quantity' => - $this->quantity
            ]);
        }
    }

    public function pay()
    {
        if($this->status!=ORDER::STATUS_UNPAYED){
            return false;
        }

        return Yii::$app->db->transaction(function(){
            $oldStatus = $this->status;
            
            $this->status = Order::STATUS_PAYED;
            $this->payedAt = date('Y-m-d H:i:s');
            $this->saveAndCheckResult();

            $this->product->updateCounters(['saledNumber' => 1]);
            $user = $this->user;
            if($user->userType==User::USER_TYPE_NORMAL){
                $user->userType = User::USER_TYPE_MEMBER;
                $user->saveAndCheckResult();
            }

            $this->finance();

            return true;
        });
        
        return false;
    }

    public function send()
    {
        if($this->status!=ORDER::STATUS_PAYED){
            return false;
        }

        if($this->validate()){
            return Yii::$app->db->transaction(function(){
                $oldStatus = $this->status;
                
                $this->status = Order::STATUS_SENDED;
                $this->sendedAt = date('Y-m-d H:i:s');
                $this->saveAndCheckResult();

                $data = [
                    'first' => '您好，您有一个订单已经发货，请及时查看并收货',
                    'keyword1' => $this->sn,
                    'keyword2' => $this->statusText,
                    'keyword3' => date('Y年m月d日 H:i:s'),
                    'keyword4' => $this->address,
                    'remark' => '如有疑问，请联系我们。'
                ];

                WeixinTemplateMessage::send($this->user->weixin, '0FTHOKyLq-YeopYDptUstLD9s-_JUfEa3lHMn-5WWKk', $data);

                return true;
            });
        }
        
        return false;
    }

    public function finish()
    {
        return Yii::$app->db->transaction(function(){
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
            // 员工交易流水
            $tradingRecord = new TradingRecord;
            $tradingRecord->userId = $employee->id;
            $tradingRecord->userType = Finance::USER_TYPE_EMPLOYEE;
            $tradingRecord->tradingType = TradingRecord::TRADING_RECORD_INCOME;
            $tradingRecord->itemId = $this->id;
            $tradingRecord->itemType = TradingRecord::ITEM_TYPE_ORDER;
            $tradingRecord->amount = $this->totalAmount * $employee->rate / 100;
            $tradingRecord->name = "收入订单{$tradingRecord->amount}元分成";
            $tradingRecord->saveAndCheckResult();

            $employee->updateCounters([
                'finishedNumber' => $tradingRecord->amount,
            ]);
        }

        $parent = $user->parent;
        $level = 0;
        $levels = [
            Yii::$app->settings->get('system', 'level1Number', 0.08), 
            Yii::$app->settings->get('system', 'level2Number', 0.07),
            Yii::$app->settings->get('system', 'level3Number', 0.08)
        ];

        while($parent && $level<5){
            if($parent->userType==User::USER_TYPE_MEMBER){
                // 层级限制
                if($level<3){
                    // 每月限额限制 会员用户
                    if($this->userType == User::USER_TYPE_MEMBER && $parent->monthLimit > $parent->thisMonthIncome + $this->totalAmount * $levels[$level]){
                        // 用户交易流水
                        $tradingRecord = new TradingRecord;
                        $tradingRecord->userId = $parent->id;
                        $tradingRecord->userType = Finance::USER_TYPE_USER;
                        $tradingRecord->tradingType = TradingRecord::TRADING_RECORD_INCOME;
                        $tradingRecord->itemId = $this->id;
                        $tradingRecord->itemType = TradingRecord::ITEM_TYPE_ORDER;
                        $tradingRecord->amount = $this->totalAmount * $levels[$level];
                        $tradingRecord->name = "收入订单{$tradingRecord->amount}元分成收入";
                        $tradingRecord->saveAndCheckResult();

                        $data = [
                            'thisMonthIncome' => $tradingRecord->amount,
                            'totalIncome' => $tradingRecord->amount
                        ];

                        $data['level' . ($level + 1) . 'Count'] = $tradingRecord->amount;

                        $parent->updateCounters($data);

                        $data = [
                            'first' => '您好，您有一个下级支付成功了',
                            'keyword1' => $this->user->nickname,
                            'keyword2' => $this->product->name,
                            'keyword3' => $this->totalAmount,
                            'keyword4' => date('Y年m月d日 H:i:s'),
                            'remark' => '感谢你的支持。'
                        ];

                        WeixinTemplateMessage::send($parent->weixin, '0JkaU3PMrqPaB14gCTJHOM1NVz19_1Snnj7IvWd677s', $data);
                    }
                }
            }elseif($parent->userType==User::USER_TYPE_UNLIMITED){
                // 无限级用户 ，其实是最多10级
                $tradingRecord = new TradingRecord;
                $tradingRecord->userId = $parent->id;
                $tradingRecord->userType = Finance::USER_TYPE_USER;
                $tradingRecord->tradingType = TradingRecord::TRADING_RECORD_INCOME;
                $tradingRecord->itemId = $this->id;
                $tradingRecord->itemType = TradingRecord::ITEM_TYPE_ORDER;
                $tradingRecord->amount = $this->totalAmount * Yii::$app->settings->get('system', 'levelUnlimitedNumber', 0.05);
                $tradingRecord->name = "收入订单{$tradingRecord->amount}元分成收入";
                $tradingRecord->saveAndCheckResult();

                $data = [
                    'thisMonthIncome' => $tradingRecord->amount,
                    'totalIncome' => $tradingRecord->amount
                ];

                $data['level' . ($level + 1) . 'Count'] = $tradingRecord->amount;

                $parent->updateCounters($data);

                $data = [
                    'first' => '您好，您有一个下级支付成功了',
                    'keyword1' => $this->user->nickname,
                    'keyword2' => $this->product->name,
                    'keyword3' => $this->totalAmount,
                    'keyword4' => date('Y年m月d日 H:i:s'),
                    'remark' => '感谢你的支持。'
                ];

                WeixinTemplateMessage::send($parent->weixin, '0JkaU3PMrqPaB14gCTJHOM1NVz19_1Snnj7IvWd677s', $data);
            }elseif($this->userType==User::USER_TYPE_OFFICIAL){
                if($level==1){
                    // 官方用户交易流水
                    $tradingRecord = new TradingRecord;
                    $tradingRecord->userId = $parent->id;
                    $tradingRecord->userType = Finance::USER_TYPE_USER;
                    $tradingRecord->tradingType = TradingRecord::TRADING_RECORD_INCOME;
                    $tradingRecord->itemId = $this->id;
                    $tradingRecord->itemType = TradingRecord::ITEM_TYPE_ORDER;
                    $tradingRecord->amount = $this->totalAmount * Yii::$app->settings->get('system', 'levelOfficialNumber', 0.20);
                    $tradingRecord->name = "收入订单{$tradingRecord->amount}元分成收入";
                    $tradingRecord->saveAndCheckResult();

                    $data = [
                        'thisMonthIncome' => $tradingRecord->amount,
                        'totalIncome' => $tradingRecord->amount
                    ];

                    $data['level' . ($level + 1) . 'Count'] = $tradingRecord->amount;

                    $parent->updateCounters($data);

                    $data = [
                        'first' => '您好，您有一个下级支付成功了',
                        'keyword1' => $this->user->nickname,
                        'keyword2' => $this->product->name,
                        'keyword3' => $this->totalAmount,
                        'keyword4' => date('Y年m月d日 H:i:s'),
                        'remark' => '感谢你的支持。'
                    ];

                    WeixinTemplateMessage::send($parent->weixin, '0JkaU3PMrqPaB14gCTJHOM1NVz19_1Snnj7IvWd677s', $data);
                }

                break;
            }

            $level++;
            $parent = $parent->parent;
        }
    }
}
