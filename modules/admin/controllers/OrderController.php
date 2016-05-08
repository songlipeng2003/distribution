<?php

namespace app\modules\admin\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Order;
use app\models\search\OrderSearch;
use app\modules\admin\models\PrintExpressForm;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionSend($id)
    {
        $model = $this->findModel($id);

        $model->scenario = Order::SCENARIO_SEND;

        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('send', [
                'model' => $model,
            ]);
        }
    }

    public function actionPrint($id)
    {
        $order = $this->findModel($id);

        $model = new PrintExpressForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->redirect(['express', 'id' => $order->id, 'expressId' => $model->expressId]);
        } else {
            return $this->render('print', [
                'model' => $model,
                'order' => $order
            ]);
        }
    }

    public function actionExpress($id, $expressId){
        $order = $this->findModel($id);

        $this->layout = false;

        return $this->render('express', [
            'order' => $order
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
