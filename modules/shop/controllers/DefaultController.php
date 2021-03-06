<?php

namespace app\modules\shop\controllers;

use Yii;

use yii\web\Controller;

use app\models\Notice;
use app\models\Product;
use app\models\search\ProductSearch;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $lastNotice = Notice::find()->orderBy('id DESC')->one();

        $searchModel = new ProductSearch();
        $searchModel->status = Product::STATUS_ON;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'lastNotice' => $lastNotice,
            'products' => $dataProvider->getModels()
        ]);
    }
}
