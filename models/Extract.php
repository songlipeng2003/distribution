<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;

use Pingpp\Pingpp;
use Pingpp\RedEnvelope;

use app\models\Finance;
use app\models\behaviors\SnBehavior;
use app\modules\weixin\models\WeixinTemplateMessage;

/**
 * 提现
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $amount
 * @property integer $toAmount
 * @property integer $status
 * @property string $createdAt
 * @property string $operatedAt
 */
class Extract extends BaseModel
{
    const STATUS_APPLYED = 1;

    const STATUS_PROCESSED = 2;

    const STATUS_FINISHED = 3;

    public static $statuses = [
        self::STATUS_APPLYED => '已申请',
        self::STATUS_PROCESSED => '已处理',
        self::STATUS_FINISHED => '已完成'
    ];

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
            [['amount'], 'integer', 'min' => 5, 'max' => 200],
            ['amount', function($attribute, $params){
                $finance = Finance::getByUser(Finance::USER_TYPE_USER, $this->userId);
                if($this->isNewRecord && $finance->balance<$this->amount){
                    $this->addError($attribute, "余额不足");
                }
            }]
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
            'status' => '状态',
            'weixinRedEnvelope' => '微信红包编号',
            'transactionNo' => '微信红包交易流水号',
            'createdAt' => '创建时间',
            'operatedAt' => '操作时间',
        ];
    }

    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => null,
                'value' => function() { return date('Y-m-d H:i:s'); }
            ],
            [
                'class' => SnBehavior::className()
            ]
        ];
    }

    public function getStatusText()
    {
        return self::$statuses[$this->status];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            $tradingRecord = new TradingRecord;
            $tradingRecord->userId = $this->userId;
            $tradingRecord->userType = Finance::USER_TYPE_USER;
            $tradingRecord->tradingType = TradingRecord::TRADING_RECORD_EXTRACT;
            $tradingRecord->itemId = $this->id;
            $tradingRecord->itemType = TradingRecord::ITEM_TYPE_EXTRACT;
            $tradingRecord->amount = - $this->amount;
            $tradingRecord->name = "提现{$this->amount}元";
            $tradingRecord->saveAndCheckResult();


            $finance = Finance::getByUser(Finance::USER_TYPE_USER, $this->userId);

            $data = [
                'first' => '您好，您刚刚申请提现已经成功',
                'keyword1' => $this->user->nickname,
                'keyword2' => date('Y年m月d日 H:i:s'),
                'keyword3' => $this->amount,
                'keyword4' => $finance->balance,
                'keyword5' => '提现',
                'remark' => '感谢你的使用。'
            ];

            WeixinTemplateMessage::send($this->user->weixin, 'AcpmPoQ99iu82lK-8UvsXQ1v9dhLp43Qq4N71aHjxHE', $data);
        }
    }

    public function sendWeixinRedPaper()
    {
        if($this->status!=self::STATUS_APPLYED){
            throw new \Exception("error extract status");
        }

        return Yii::$app->db->transaction(function(){
            $this->toAmount = $this->amount - 1;
            $this->status = self::STATUS_PROCESSED;

            Pingpp::setApiKey($_ENV['PINGXX_APIKEY']);
            $redEnvelope = RedEnvelope::create([
                'order_no'    => $this->sn,
                'app'         => ['id' => $_ENV['PINGXX_APPKEY']],
                'channel'     => 'wx_pub',//红包基于微信公众帐号，所以渠道是 wx_pub
                'amount'      => $this->toAmount * 100,//金额在 100-20000 之间
                'currency'    => 'cny',
                'subject'     => '提现',
                'body'        => '提现',
                'extra'       => [
                    "nick_name" => "提现",
                    "send_name" => "眯糊时光"
                ],//extra 需填入的参数请参阅 API 文档
                'recipient'   => $this->user->weixin,//指定用户的 open_id
                'description' => '提现'
            ]);

            $this->weixinRedEnvelope = $redEnvelope->id;
            return $this->saveAndCheckResult();
        });
    }

    public function finish()
    {  
        if($this->status!=self::STATUS_PROCESSED){
            throw new \Exception("error extract status");
        }

        $this->status = self::STATUS_FINISHED;
        $this->operatedAt = date('Y-m-d H:i:s');
        return $this->save();
    }
}
