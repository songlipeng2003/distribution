<?php

namespace app\modules\employee\controllers\v1;

use Yii;

use yii\filters\auth\CompositeAuth;

use app\controllers\ApiController;
use app\filters\QueryParamAuth;

class UserController extends ApiController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'user' => Yii::$app->employee,
            'authMethods' => [
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    /**
     * 修改密码
     * @api {POST} sub-company-api/v1/user/change-password 修改密码
     * @apiVersion 1.0.0
     * @apiGroup subCompany/Account
     * 
     * @apiParam {String} access-token  token
     * @apiParam {String} password      新密码
     * @apiParam {String} oldPassword   原密码
     * 
     * @apiDescription 用户修改密码接口
     * 
     * @apiSuccess {String} code 0 重置密码成功
     * @apiError   {String} code 1 重置密码失败
     * @apiError   {String} msg 错误信息
     *
     * @apiExample {json} 返回数据格式
     *     {
     *          "code": 0,
     *     }
     *     
     * @apiErrorExample {json} 返回数据格式
     *      {
     *           "code": 1,
     *           "msg": "用户不存在"
     *      }
     */
    public function actionChangePassword()
    {
        $password = Yii::$app->request->post('password');
        $oldPassword = Yii::$app->request->post('oldPassword');

        $employee = Yii::$app->employee->identity;
        if(!$employee->validatePassword($oldPassword)){
            return [
                'code' => 1,
                'msg' => '原始密码错误'
            ];
        }

        if(!$password){
            return [
                'code' => 1,
                'msg' => '密码不可以为空'
            ];
        }

        if(strlen($password)<6 || strlen($password)>20){
            return [
                'code' => 1,
                'msg' => '密码长度必须为6-20位'
            ];
        }

        $employee->password = md5($password);
        if($employee->save()){
            return [
                'code' => 0
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '密码长度必须为6-20位'
            ];
        }
    }
}
