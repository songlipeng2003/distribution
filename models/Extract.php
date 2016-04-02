<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;

use Pingpp\Pingpp;
use Pingpp\RedEnvelope;

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
            [['userId', 'amount', 'toAmount'], 'integer'],
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
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => null,
                'value' => function() { return date('Y-m-d H:m:i'); }
            ],
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

    public function sendWeixinRedPaper()
    {
        if($this->status!=self::STATUS_APPLYED){
            throw new \Exception("error extract status");
        }

        $this->toAmount = $this->amount - 1;
        $this->status = self::STATUS_PROCESSED;

        Pingpp::setApiKey($_ENV['PINGXX_APIKEY']);
        $redEnvelope = RedEnvelope::create([
            'order_no'    => $this->id,
            'app'         => ['id' => $_ENV['PINGXX_APPKEY']],
            'channel'     => 'wx_pub',//红包基于微信公众帐号，所以渠道是 wx_pub
            'amount'      => $this->toAmount * 100,//金额在 100-20000 之间
            'currency'    => 'cny',
            'subject'     => '提现',
            'body'        => '提现',
            'extra'       => [
                "nick_name" => "提现",
                "send_name" => "吃货App"
            ],//extra 需填入的参数请参阅 API 文档
            'recipient'   => $this->user->openid,//指定用户的 open_id
            'description' => '提现'
        ]);

        $this->weixinRedEnvelope = $redEnvelope->id;
        return $this->save();
    }

    public function finish()
    {  
        if($this->status!=self::STATUS_PROCESSED){
            throw new \Exception("error extract status");
        }

        $this->status = self::STATUS_FINISHED;
        return $this->save();
    }
}
