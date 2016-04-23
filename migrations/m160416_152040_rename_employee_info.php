<?php

use yii\db\Migration;

class m160416_152040_rename_employee_info extends Migration
{
    public function up()
    {
        $this->renameColumn('employee', 'month_index', 'monthIndex');
        $this->renameColumn('employee', 'finished_number', 'finishedNumber');
    }

    public function down()
    {
        $this->renameColumn('employee', 'monthIndex', 'month_index');
        $this->renameColumn('employee', 'finishedNumber', 'finished_number');

        return true;
    }
}
