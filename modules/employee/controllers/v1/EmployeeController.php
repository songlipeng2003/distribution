<?php

namespace app\modules\employee\controllers\v1;

use Yii;

use yii\filters\auth\CompositeAuth;
use app\lib\data\ActiveDataProvider;

use app\controllers\ApiController;
use app\filters\QueryParamAuth;
use app\models\Employee;

class EmployeeController extends ApiController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'user' => Yii::$app->employee,
            'authMethods' => [
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {

        $employees = Employee::find();
        return new ActiveDataProvider([
            'query' => $employees,
            'sort'=> [
                'defaultOrder' => ['month_index'=>SORT_DESC]
            ],               
        ]);
    }
}
