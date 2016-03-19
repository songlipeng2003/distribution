<?php

namespace app\modules\employee\controllers\v1;

use Yii;

use app\controllers\ApiController;
use app\modules\employee\models\LoginForm;

class AccountController extends ApiController
{
    public function actionLogin()
    {
        $loginForm = new LoginForm();
        $loginForm->load([
            'LoginForm' => Yii::$app->request->bodyParams
        ]);

        if($loginForm->login()){
            return [
                'code' => 0,
                'data' => $loginForm->user
            ];
        }else{
            $errors = $loginForm->errors;
            return [
                'code' => 1,
                'msg' => reset($errors)[0]
            ];
        }
    }    
}