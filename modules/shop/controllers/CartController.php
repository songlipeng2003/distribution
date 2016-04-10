<?php

namespace app\modules\shop\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;

use app\models\Product;
use app\modules\shop\models\QuickCheckoutForm;

class CartController extends Controller
{

    public $enableCsrfValidation = false;   

    public function actionQuickCheckout($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost){
            $model = new QuickCheckoutForm;
            $model->productId = $id;

            Yii::$app->response->format = Response::FORMAT_JSON;

            if($model->load(Yii::$app->request->post()) && $model->checkout()){
                $order = $model->order;

                return ['result' => 0, 'data' => $order];
            }else{
                return ['result' => 1, 'msg' => array_values($model->errors)[0]];
            }
        }

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
