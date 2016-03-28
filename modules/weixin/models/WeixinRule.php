<?php

namespace app\modules\weixin\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use EasyWeChat\Message\Text;

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
                'value' => function() { return date('Y-m-d H:m:i'); }
            ],
        ];
    }

    public function getWeixinArticle()
    {
        return $this->hasOne(WeixinArticle::className(), ['id' => 'weixinArticleId']);
    }

    public static function handleRule($msg)
    {
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
        $weixinRule = WeixinRule::findOne(['keyword' => '订阅']);
        if($weixinRule){
            $text = new Text();
            $text->content = $weixinRule->weixinArticle->content;

            return $text;
        }

        return null;
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
