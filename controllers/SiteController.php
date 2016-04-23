<?php

namespace app\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Response;

use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\lib\Enum;

use app\models\LoginForm;
use app\models\ContactForm;

use app\components\Utils;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'upload' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'web';
        return $this->render('index');
    }

    public function actionLogin()
    {
        if(Utils::isInWeixin()){
            if (!\Yii::$app->user->isGuest) {
                return $this->redirect(['/shop/']);
            }else{
                return $this->redirect(['weixin/auth/login']);
            }
        }else{
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionQrcode()
    {
        $text = Yii::$app->request->get('text');
        Yii::$app->response->format = Response::FORMAT_RAW;
        header("Content-Type: image/jpeg");
        return QrCode::jpg($text, false, Enum::QR_ECLEVEL_Q, 10, 1);
    }

    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName('Filedata');

        $ext = $file->getExtension();
        $fileTypes = array('jpg','jpeg','gif','png');

        Yii::$app->response->format = Response::FORMAT_JSON;
    
        if (in_array($ext, $fileTypes)) {
            $filename = uniqid() . '.' . $ext;
            $path = Yii::getAlias("@webroot") . '/uploads/tmp/';
            if(!file_exists($path)){
                mkdir($path, 0777, true);
            }
            $file->saveAs($path . $filename);
            
            return [
                'result' => 0,
                'file' => '/uploads/tmp/' . $filename
            ];
        } else {
            return [
                'result' => 1,
                'msg' => '非法的文件类型'
            ];
        }
    }
}
