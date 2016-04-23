<?php

namespace app\modules\admin\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\modules\admin\models\System;

class SystemController extends Controller
{
    public function actionIndex()
    {
        $params = System::loadAllParams();

        return $this->render('index', [
            'params' => $params,
        ]);
    }
}
