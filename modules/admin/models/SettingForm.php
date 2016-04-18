<?php

namespace app\modules\admin\models;

use Yii;

use yii\base\Model;

class SettingForm extends Model
{
    public $shipName;
    public $shipPhone;
    public $shipCity;
    public $shipCompany;
    public $shipAddress;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['shipName', 'shipPhone', 'shipCity', 'shipCompany', 'shipAddress'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shipName' => '寄件人姓名',
            'shipPhone' => '寄件人联系电话',
            'shipCity' => '寄件人始发地',
            'shipCompany' => '寄件人单位名称',
            'shipAddress' => '寄件人地址'
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
