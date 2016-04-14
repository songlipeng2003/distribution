<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;

use app\models\Extract;
use app\models\Finance;

class ExtractController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionCreate()
    {
        $model = new Extract();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->userId = Yii::$app->user->id;
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($model->save()){
                return ['result' => 0, 'data' => $model];
            }else{
                return ['result' => 1, 'msg' => array_values($model->errors)[0]];
            }
        } else {
            $finance = Finance::getByUser(Finance::USER_TYPE_USER, Yii::$app->user->id);

            return $this->render('create', [
                'finance' => $finance,
                'model' => $model,
            ]);
        }
    }
}
