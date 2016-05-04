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
            'monthLimit' => new Expression("FLOOR(8000 + (RAND() * 30888));"),
            'thisMonthIncome' => 0.0
        ], ['userType' => User::USER_TYPE_MEMBER]);

        User::updateAll([
            'monthLimit' => 999999,
            'thisMonthIncome' => 0.0
        ], ['userType' => User::USER_TYPE_UNLIMITED]);


        Employee::updateAll([
            'lastMonthNumber' => new Expression("finishedNumber"),
            'finishedNumber' => 0,
        ]);
    }
}
