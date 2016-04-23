<?php

namespace app\modules\admin\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\modules\admin\models\SettingForm;

class SettingController extends Controller
{
    public function actionIndex()
    {
        $model = new SettingForm();
        $model->loadValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '保存成功');
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
