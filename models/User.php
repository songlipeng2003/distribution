<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;

use app\modules\weixin\models\WeixinUser;
use app\modules\weixin\models\Weixin;

class User extends BaseModel implements \yii\web\IdentityInterface
{
    const USER_TYPE_NORMAL = 1;

    const USER_TYPE_MEMBER = 2;

    const USER_TYPE_LIMITED = 3;

    public static $userTypes = [
        self::USER_TYPE_NORMAL => '代言人候选人',
        self::USER_TYPE_MEMBER => '代言人',
        self::USER_TYPE_LIMITED => '超级代言人',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['userType', 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'userType' => '用户类型',
            'avatar' => '头像',
            'totalIncome' => '总收入',
            'thisMonthIncome' => '本月收入',
            'monthLimit' => '本月额度',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
            'parentId' => '父',
            'lastLoginedAt' => '最后登录时间',
            'monthLimit' => '本月限额',
            'thisMonthIncome' => '本月收入',
            'totalIncome' => '总收入',
            'userType' => '用户类型',
            'level1Number' => '1级下线数',
            'level2Number' => '2级下线数',
            'level3Number' => '3级下线数',
            'nickname' => '昵称',
            'employeeId' => '员工'
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        return self::findOne(['token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return md5($this->username . $this->password);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getParent()
    {
        return $this->hasOne(User::className(), ['id' => 'parentId']);
    }

    public function getChildren()
    {
        return $this->hasMany(User::className(), ['parentId' => 'id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->monthLimit = rand(8000, 38888);
            }

            return true;
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            if($this->parent){
                $this->parent->updateLevel1Number();

                if($this->parent->parent){
                    $this->parent->parent->updateLevel2Number();

                    if($this->parent->parent->parent){
                        $this->parent->parent->parent->updateLevel3Number();
                    }
                }
            }
        }
    }

    public function updateLevel1Number()
    {
        $number = $this->getChildren()->count();
        return self::updateAll(['level1Number' => $number], ['id' => $this->id]);
    }

    public function updateLevel2Number()
    {
        $number = self::find()->leftJoin('user AS parent', 'parent.id=user.parentId')->where(['parent.parentId' => $this->id])->count();
        return self::updateAll(['level2Number' => $number], ['id' => $this->id]);
    }

    public function updateLevel3Number()
    {
        $number = self::find()->leftJoin('user AS parent', 'parent.id=user.parentId')
            ->leftJoin('user AS parent2', 'parent2.id=parent.parentId')
            ->where(['parent2.parentId' => $this->id])->count();
        return self::updateAll(['level3Number' => $number], ['id' => $this->id]);
    }

    public function getOpenid()
    {
        return $this->weixin;
    }

    public function getWeixinUser()
    {
        return $this->hasOne(WeixinUser::className(), ['openid' => 'weixin']);
    }

    public function getNickname()
    {
        return $this->weixinUser ?  $this->weixinUser->nickname : '';
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employeeId']);
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['userId' => 'id']);
    }

    public function getThisMonthRate()
    {
        return $this->thisMonthIncome / $this->monthLimit;
    }

    public function getUserTypeText()
    {
        return self::$userTypes[$this->userType];
    }

    public function getSpreadUrl()
    {
        $app = Weixin::getApplication();
        $qrcode = $app->qrcode;

        $result = $qrcode->temporary($this->id + 10000 * 10, 6 * 24 * 3600);
        // $ticket = $result->ticket;
        // $expireSeconds = $result->expire_seconds;
        $url = $result->url;

        return $url;
    }

    public function getTotalLevelNumber()
    {
        return $this->level1Number+$this->level2Number+$this->level3Number;
    }
}
