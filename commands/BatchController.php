<?php
namespace app\commands;

use yii\console\Controller;
use yii\db\Expression;

use app\models\User;
use app\models\Employee;

class BatchController extends Controller
{
    public function actionMonth()
    {
        User::updateAll([
            'monthLimit' => new Expression("FLOOR(8000 + (RAND() * 30888));"),
            'thisMonthIncome' => 0.0
        ]);

        Employee::updateAll([
            'lastMonthNumber' => new Expression("finishedNumber"),
            'finishedNumber' => 0,
        ]);
    }
}
