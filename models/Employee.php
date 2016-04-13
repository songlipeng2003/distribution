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
 * @property string $rate
 */
class Employee extends ActiveRecord implements IdentityInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    public static $statuses = [
        self::STATUS_ENABLED => '可用',
        self::STATUS_DISABLED => '不可用'
    ];

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
            [['username', 'password', 'name', 'email', 'phone'], 'string', 'max' => 255],
            ['rate', 'integer', 'min' => 1, 'max' => 99]
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
            'rate' => '费率'
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => function() { return date('Y-m-d H:i:s'); }
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

    public function getStatusText()
    {
        return self::$statuses[$this->status];
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
        return static::findOne(['token' => $token, 'status' => self::STATUS_ENABLED]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ENABLED]);
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
