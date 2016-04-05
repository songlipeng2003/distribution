<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

use app\modules\weixin\models\Weixin;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $token
 * @property integer $status
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $lastLoginedAt
 */
class Employee extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'phone'], 'required'],
            [['status'], 'integer'],
            ['username', 'match', 'pattern' => '/\w{5,20}/', 'message' => '用户名格式错误，只能英文或数字或_,必须5-20位'],
            [['username', 'password', 'name', 'email', 'phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'username' => '用户名',
            'password' => '密码',
            'name' => '姓名',
            'email' => 'Email',
            'phone' => '电话',
            'token' => 'Token',
            'status' => '状态',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
            'lastLoginedAt' => '最近登录时间',
        ];
    }

    public function behaviors()
    {
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

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->token = Yii::$app->getSecurity()->generateRandomString();
            }

            if(strlen($this->password)!=32){
                $this->password = md5($this->password);
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->token;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password==md5($password);
    }

    public function getSpreadUrl()
    {
        $app = Weixin::getApplication();
        $qrcode = $app->qrcode;

        $result = $qrcode->temporary($this->id, 6 * 24 * 3600);
        $url = $result->url;

        return $url;
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields[] = 'spreadUrl';

        return $fields;
    }
}
