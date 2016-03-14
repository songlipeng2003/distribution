<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

use app\models\Admin;

class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $confirmPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'confirmPassword'], 'required'],
            ['oldPassword', 'validatePassword'],
            ['confirmPassword','compare','compareAttribute' => 'newPassword','message' => '两次密码不一致'],
            [['newPassword'], 'string', 'min' => 6, 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => '老密码',
            'newPassword' => '新密码',
            'confirmPassword' => '重复密码'
        ];
    }

    public function validatePassword($attribute, $params){
        if (!$this->hasErrors()) {
            $user = Admin::findOne(Yii::$app->admin->id);

            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, '原始密码错误');
            }
        }
    }

    public function changePassword()
    {
        if($this->validate()){
            $user = Admin::findOne(Yii::$app->admin->id);
            $user->password = md5($this->newPassword);

            if($user->save()){
                return true;
            }
        }

        return false;
    }
}