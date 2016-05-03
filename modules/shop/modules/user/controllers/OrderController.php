<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\data\ActiveDataProvider;

use Pingpp\Pingpp;
use Pingpp\Charge;

use app\models\Order;
use app\models\search\OrderSearch;

class OrderController extends Controller
{
    public $enableCsrfValidation = false;   

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        $query = $user->getOrders()->where("status>=:status", ['status' => Order::STATUS_PAYED]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPay($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost){
            Pingpp::setApiKey($_ENV['PINGXX_APIKEY']);

            Yii::$app->response->format = Response::FORMAT_JSON;
            return Charge::create(array(
                'order_no'  => $model->sn,
                'amount'    => $model->totalAmount * 100,
                // 'amount'    => 1,
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

    public function actionPaySuccess()
    {
        return $this->render('pay-success');
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null && $model->userId == Yii::$app->user->id) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
