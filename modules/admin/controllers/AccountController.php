<?php

namespace app\modules\admin\controllers;

use Yii;

use yii\web\Controller;

use app\modules\admin\models\ChangePasswordForm;
use app\modules\admin\models\LoginForm;

class AccountController extends Controller
{
    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->session->setFlash('success', '密码修改成功');

            return $this->redirect(['change-password']);
        } else {
            return $this->render('change-password', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->redirect(array('default/index'));
        }
        

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(array('default/index'));
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->redirect(array('account/login'));
    }
}
