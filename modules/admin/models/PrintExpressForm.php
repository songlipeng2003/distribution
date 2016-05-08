<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

use app\models\Admin;

class PrintExpressForm extends Model
{
    public $expressId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expressId'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expressId' => '快递',
        ];
    }
}