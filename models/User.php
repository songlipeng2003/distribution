<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

use app\modules\weixin\models\WeixinUser;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'avatar' => '头像',
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
        return $this->hasOne(User::className(), ['parentId' => 'id']);
    }

    public function getChildren()
    {
        return $this->hasMany(User::className(), ['id' => 'parentId']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($inster, $changedAttributes);

        if($insert){
            if($this->parent){
                $this->parent->updateLevel1Number();

                if($this->parent->parent){
                    $this->parent->parent->updateLevel1Number();

                    if($this->parent->parent->parent){
                        $this->parent->parent->parent->updateLevel1Number();
                    }
                }
            }
        }
    }

    public function calLevel1Number()
    {
        return $this->getChildren()->count();
    }

    public function calLevel2Number()
    {
        $sql = "SELECT COUNT(*) 
            FROM user u LEFT JOIN user p on u.parent_id=p.id 
            WHERE p.parent_id=" . $this->userId;
        return $this->countBySql($sql);
    }

    public function calLevel3Number()
    {
        $sql = "SELECT COUNT(*) 
            FROM user u LEFT JOIN user p on u.parent_id=p.id LEFT JOIN user p2 on p.parent_id=p2.id 
            WHERE p2.parent_id=" . $this->userId;
        return $this->countBySql($sql);
    }

    public function getOpenid()
    {
        return $this->weixin;
    }

    public function getWeixinUser()
    {
        return $this->hasOne(WeixinUser::className(), ['openid' => 'weixin']);
    }
}
