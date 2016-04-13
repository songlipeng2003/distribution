<?php
namespace app\commands;

use yii\console\Controller;
use yii\db\Expression;

use app\models\User;


class BatchController extends Controller
{
    public function actionUpdateMonthLimit()
    {
        User::updateAll(['monthLimit' => new Expression("FLOOR(8000 + (RAND() * 30888));")]);
    }
}
