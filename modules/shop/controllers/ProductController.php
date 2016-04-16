<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\models\Product;

class ProductController extends Controller
{
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'images' => $model->getImages(),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null && $model->status==Product::STATUS_ON) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
