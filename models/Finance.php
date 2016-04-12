<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "finance".
 *
 * @property integer $id
 * @property integer $userType
 * @property integer $userId
 * @property string $balance
 * @property string $freeze
 * @property string $createdAt
 * @property string $updatedAt
 */
class Finance extends BaseModel
{
    const USER_TYPE_PLATEFORM = 1;

    const USER_TPYE_COMPANY = 2;

    const USER_TYPE_USER = 3;

    const USER_TYPE_EMPLOYEE = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userType', 'userId'], 'integer'],
            [['balance', 'freeze'], 'number'],
            [['userType', 'userId'], 'unique', 'targetAttribute' => ['userType', 'userId'], 'message' => 'The combination of User Type and User ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userType' => 'User Type',
            'userId' => 'User ID',
            'balance' => 'Balance',
            'freeze' => 'Freeze',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    public function behaviors(){
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => function() { return date('Y-m-d H:i:s'); }
            ],
        ];
    }

    public static function getByUser($userType, $userId){
        $finance = self::findOne([
            'userType'=>$userType,
            'userId'=>$userId
        ]);
        if(!$finance){
            if($userType && ($userId || $userId==0)){
                $model = new Finance();
                $model->userType = $userType;
                $model->userId = $userId;
                $model->save();
    
                $finance = self::findOne([
                    'userType'=>$userType,
                    'userId'=>$userId
                ]);
            }else{
                throw new \Exception("严重错误，缺少类型为{$userType},ID为{$userId}的资金账户");
            }
        }
    
        return $finance;
    }

    public function getTotalBalance()
    {
        return $this->balance + $this->freeze;
    }
}
