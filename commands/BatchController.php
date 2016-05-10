<?php
namespace app\commands;

use yii\console\Controller;
use yii\db\Expression;

use app\models\User;
use app\models\Employee;

class BatchController extends LockController
{
    public function actionMonth()
    {
        User::updateAll([
            'thisMonthIncome' => 0.0,
            'thisMonthSaleroom' => 0.0,
        ]);

        Employee::updateAll([
            'lastMonthNumber' => new Expression("finishedNumber"),
            'finishedNumber' => 0,
        ]);
    }
}
