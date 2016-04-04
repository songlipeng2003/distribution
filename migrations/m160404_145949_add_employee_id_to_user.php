<?php

use yii\db\Migration;

class m160404_145949_add_employee_id_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'employeeId', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('user', 'employeeId');
        return true;
    }
}
