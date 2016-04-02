<?php
namespace app\commands;

use yii\console\Controller;

use app\models\Extract;

class ExtractController extends Controller
{
    public function actionIndex()
    {
        foreach(Extract::find()->where(['status' => Extract::STATUS_APPLYED])->each(10) as $extract){
            $extract = Extract::findOne($extract->id);
            if($extract && $extract->status = Extract::STATUS_APPLYED){
                $extract->sendWeixinRedPaper();
            }
        }
    }
}
