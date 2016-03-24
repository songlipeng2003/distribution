<?php

namespace app\modules\shop\controllers;

use app\models\Product;

use yii\web\Controller;

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
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
