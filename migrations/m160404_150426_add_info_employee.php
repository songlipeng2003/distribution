<?php

use yii\db\Migration;

class m160404_150426_add_info_employee extends Migration
{
    public function up()
    {
        $this->addColumn('employee', 'school', $this->string());
        $this->addColumn('employee', 'month_index', $this->integer());
        $this->addColumn('employee', 'salary', $this->integer());
        $this->addColumn('employee', 'finished_number', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('employee', 'school');
        $this->dropColumn('employee', 'month_index');
        $this->dropColumn('employee', 'salary');
        $this->dropColumn('employee', 'finished_number');

        return true;
    }
}
