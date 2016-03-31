<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use app\models\Order;
use app\models\search\OrderSearch;

use yii\web\Controller;

class OrderController extends Controller
{
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

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null && $model->user_id == Yii::$app->user->id) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
