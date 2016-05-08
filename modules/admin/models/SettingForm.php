<?php

namespace app\modules\admin\models;

use Yii;

use yii\base\Model;

class SettingForm extends Model
{
    public $siteName;
    public $siteDescription;

    // weixin 
    public $weixinName;
    public $weixinCode;
    public $weixinAppId;
    public $weixinSecret;
    public $weixinToken;
    public $weixinAesKey;

    // ship
    public $shipName;
    public $shipPhone;
    public $shipCity;
    public $shipCompany;
    public $shipAddress;

    // 分销
    public $level1Number;
    public $level2Number;
    public $level3Number;
    public $levelUnlimitedNumber;
    public $levelOfficialNumber;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['siteName', 'required'],
            ['siteName', 'string', 'max' => 30],
            ['siteDescription', 'string', 'max' => 255],

            [['weixinName', 'weixinCode', 'weixinAppId', 'weixinSecret', 'weixinToken', 'weixinAesKey'], 'required'],

            [['shipName', 'shipPhone', 'shipCity', 'shipCompany', 'shipAddress'], 'safe'],

            [['level1Number', 'level2Number', 'level3Number', 'levelUnlimitedNumber', 'levelOfficialNumber'], 'number', 'min' => 0, 'max' =>1],
            ['level1Number', 'default', 'value' => 0.08],
            ['level2Number', 'default', 'value' => 0.07],
            ['level3Number', 'default', 'value' => 0.08],
            ['levelUnlimitedNumber', 'default', 'value' => 0.05],
            ['levelOfficialNumber', 'default', 'value' => 0.2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'siteName' => '网站名',
            'siteDescription' => '网站标题',

            'weixinName' => '公众号名称',
            'weixinCode' => '微信号',
            'weixinAppId' => '公众号APPID',
            'weixinSecret' => '公众号secert',
            'weixinToken' => '公众号Token',
            'weixinAesKey' => '微信号AESKEY',

            'shipName' => '寄件人姓名',
            'shipPhone' => '寄件人联系电话',
            'shipCity' => '寄件人始发地',
            'shipCompany' => '寄件人单位名称',
            'shipAddress' => '寄件人地址',

            'level1Number' => '一级分销提成',
            'level2Number' => '二级分销提成',
            'level3Number' => '三级分销提成',
            'levelUnlimitedNumber' => '无限级分销提成',
            'levelOfficialNumber' => '官方代言人提成'
        ];
    }

    public function loadValues()
    {
        foreach ($this->getAttributes() as $key => $value) {
            $this->$key = Yii::$app->settings->get('system', $key);
        }
    }

    public function save()
    {
        if ($this->validate()) {
            foreach ($this->getAttributes() as $key => $value) {
                Yii::$app->settings->set('system', $key, $value, 'string');
            }

            return true;
        } else {
            return false;
        }
    }
}
