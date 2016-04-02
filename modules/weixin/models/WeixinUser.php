<?php

namespace app\modules\weixin\models;

use Yii;

use yii\behaviors\TimestampBehavior;

use app\models\BaseModel;
use app\models\User;

/**
 * This is the model class for table "weixinUser".
 *
 * @property integer $id
 * @property string $openid
 * @property integer $sex
 * @property string $nickname
 * @property string $city
 * @property string $avatar
 * @property string $language
 * @property string $province
 * @property string $country
 * @property string $remark
 * @property string $groupId
 * @property string $subscribeTime
 * @property string $createdAt
 * @property string $updatedAt
 */
class WeixinUser extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['openid', 'unique'],
            [['subscribeTime'], 'safe'],
            [['openid', 'nickname', 'city', 'avatar', 'language', 'province', 'country', 'remark'], 'string', 'max' => 255],
            [['sex', 'groupId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'openid' => 'Openid',
            'nickname' => '昵称',
            'city' => '城市',
            'avatar' => '头像',
            'language' => '语言',
            'province' => '省份',
            'country' => '国家',
            'remark' => '备注',
            'groupId' => '群组',
            'subscribeTime' => '订阅时间',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }

    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => function() { return date('Y-m-d H:m:i'); }
            ],
        ];
    }

    public function getUser()
    {
        return User::findOne(['openid' => $this->openid]);
    }

    public function getSpreadUrl()
    {
        $app = Weixin::getApplication();
        $qrcode = $app->qrcode;

        $result = $qrcode->temporary($this->id, 6 * 24 * 3600);
        // $ticket = $result->ticket;
        // $expireSeconds = $result->expire_seconds;
        $url = $result->url;

        return $url;
    }
}
