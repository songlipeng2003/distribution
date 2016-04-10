<?php

namespace app\modules\shop\controllers;

use yii\web\Controller;

use Pingpp\Pingpp;
use Pingpp\Charge;

use app\models\Order;

class OrderController extends Controller
{

    public function actionPay($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost){
            Pingpp::setApiKey($_ENV['PINGXX_APIKEY']);

            Yii::$app->response->format = Response::FORMAT_JSON;
            return Charge::create(array(
                'order_no'  => $model->id,
                'amount'    => $model->totalAmount * 100,
                'app'       => array('id' => $_ENV['PINGXX_APPKEY']),
                'channel'   => 'wx_pub',
                'currency'  => 'cny',
                'client_ip' => '127.0.0.1',
                'subject'   => $model->product->name,
                'body'      => $model->product->name,
                'extra'     => [
                    'open_id' => Yii::$app->user->identity->weixin
                ]
            ));
        }

        return $this->render('pay', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
