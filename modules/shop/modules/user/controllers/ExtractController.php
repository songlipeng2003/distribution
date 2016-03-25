<?php

namespace app\modules\shop\modules\user\controllers;

use Yii;

use yii\web\Controller;

use app\models\Extract;

class ExtractController extends Controller
{
    public function actionCreate()
    {
        $model = new Extract();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}
