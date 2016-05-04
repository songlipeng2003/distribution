<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\models\News;

class NewsController extends Controller
{
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->layout = false;
        return $this->render('view', [
            'model' => $model
        ]);
    }

    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
