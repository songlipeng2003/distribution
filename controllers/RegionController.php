<?php

namespace app\controllers;

use app\models\Region;

class RegionController extends \yii\rest\Controller
{
    public function actionChildren($id)
    {
        return $this->findModel($id)->children(1)->all();
    }

    public function actionIndex()
    {
        return Region::find()->all();
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    protected function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
