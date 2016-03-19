<?php
namespace app\controllers;

use yii\rest\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

use Yii;

// use app\models\Application;

class ApiController extends Controller
{
    // public $_application;

    public function init()
    {
        Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['cors'] = [
            'class' => Cors::className(),
        ];
        return $behaviors;
    }

    public function actionOptions()
    {
    }

    // public function getCurrentApplication()
    // {
    //     $apiKey = Yii::$app->request->get('api-key');
    //     if(!$apiKey){
    //         $apiKey = Yii::$app->request->post('api-key');
    //     }
    //     if($apiKey){
    //         if($this->_application){
    //             return $this->_application;
    //         }
    //         return Application::findOne(['token' => $apiKey]);
    //     }
    //     return null;
    // }
}