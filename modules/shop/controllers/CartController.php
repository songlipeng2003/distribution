<?php

namespace app\modules\shop\controllers;

use app\models\Product;

use yii\web\Controller;

class CartController extends Controller
{
    public function actionQuickCheckout($id)
    {
        $model = $this->findModel($id);
        return $this->render('quick-checkout', [
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
