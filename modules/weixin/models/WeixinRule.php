<?php

namespace app\modules\weixin\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use EasyWeChat\Message\Text;

use app\models\User;
use app\models\Employee;

/**
 * This is the model class for table "weixinRule".
 *
 * @property integer $id
 * @property string $keyword
 * @property integer $weixinArticleId
 * @property string $createdAt
 * @property string $updatedAt
 */
class WeixinRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weixinRule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['keyword', 'required'],
            ['keyword', 'unique'],
            ['reply', 'required', 'when' => function($model){
                return !$this->weixinArticleId;
            }],
            [['weixinArticleId'], 'integer'],
            [['keyword'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'keyword' => '关键词',
            'reply' => '回复内容',
            'weixinArticleId' => '微信文章',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }

    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'createdAt',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updatedAt',
                ],
                'value' => function() { return date('Y-m-d H:i:s'); }
            ],
        ];
    }

    public function getWeixinArticle()
    {
        return $this->hasOne(WeixinArticle::className(), ['id' => 'weixinArticleId']);
    }

    public static function handleRule($msg)
    {
        if($msg=='二维码'){
            
        }

        $weixinRule = WeixinRule::findOne(['keyword' => $msg]);
        if($weixinRule){
            $text = new Text();
            $text->content = $weixinRule->weixinArticle->content;

            return $text;
        }else{
            return self::handleDefault();
        }

        return null;        
    }

    public static function handleSubscribe($message)
    {
        $openid = $message->FromUserName;
        $eventKey = $message->EventKey;
        $parentId = $eventKey ? str_replace('qrscene_', '', $eventKey) : null;
        $app = Weixin::getApplication();
        $userService = $app->user;
        $userInfo = $userService->get($openid);

        $weixinUser = WeixinUser::findOne(['openid' => $openid]);
        if(!$weixinUser){
            $weixinUser = new WeixinUser();
        }

        $weixinUser->openid = $openid;
        $weixinUser->nickname = $userInfo->nickname;
        $weixinUser->avatar = $userInfo->headimgurl;
        $weixinUser->sex = $userInfo->sex;
        $weixinUser->language = $userInfo->language;
        $weixinUser->city = $userInfo->city;
        $weixinUser->province = $userInfo->province;
        $weixinUser->country = $userInfo->country;
        $weixinUser->subscribeTime = date('Y-m-d H:i:s', $userInfo->subscribe_time);
        $weixinUser->remark = $userInfo->remark;
        $weixinUser->groupId = $userInfo->groupid;
        $weixinUser->isSubscribe = $userInfo->subscribe;

        if($weixinUser->saveAndCheckResult()){
            $user = User::findOne(['weixin' => $openid]);
            if(!$user){
                $user = new User();
                if($parentId){
                    if($parentId<10000 * 10){
                        $employee = Employee::findOne($parentId);
                        if($employee){
                            $user->employeeId = $parent->user->id;
                        }
                    }else{
                        $parentId = $parentId - 10000*10;
                        $parent = User::findOne($parentId);
                        if($parent){
                            $user->parentId = $parent->id;

                            $data = [
                                'first' => '您好，您有下级会员注册成功。',
                                'keyword1' => $userInfo->nickname,
                                'keyword2' => date('Y年m月d日H:i:s'),
                                'remark' => '如有疑问，请联系我们。'
                            ];

                            WeixinTemplateMessage::send($parent->weixin, 'LPvczo4tfNWkgFEUpKSRHzS1wpX7-ReKEmLTdEkkRh0', $data);
                        }
                    } 
                }
                $user->weixin = $openid;
                $user->nickname = $userInfo->nickname;
                $user->avatar = $userInfo->headimgurl;
                $user->saveAndCheckResult();
            }
        }

        $url = Yii::$app->settings->get('system', 'siteUrl', 'http://mihutime.com/shop/');

        $msg = "欢迎关注“吃货榜样”！我们为你准备了吃货们无法拒绝的进口零食大礼包——“世界这么大，带你吃掉它”，同时也恭喜你成为我们第{$user->id}合伙候选人，你仅需购买一盒大礼包即可获得" . $user->monthLimit . "元合伙人现金奖励，想到现在领取请点击<a href=\"{$url}\">了解更多</a>";
        
        $text = new Text();
        $text->content = $msg;

        return $text;
    }

    public static function handleDefault()
    {
        $weixinRule = WeixinRule::findOne(['keyword' => '*']);
        if($weixinRule){
            $text = new Text();
            $text->content = $weixinRule->weixinArticle->content;

            return $text;
        }

        return null;
    }
}
