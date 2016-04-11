<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use Pingpp\Pingpp;
use Pingpp\Charge;

use app\models\Order;
use app\models\search\OrderSearch;

class OrderController extends Controller
{
    public $enableCsrfValidation = false;   

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $searchModel->userId = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
                // 'amount'    => $model->totalAmount * 100,
                'amount'    => 1,
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
