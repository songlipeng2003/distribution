<?php

use yii\db\Migration;

class m160405_123722_modify_emloyee extends Migration
{
    public function up()
    {
        $this->alterColumn('employee', 'month_index', $this->integer()->defaultValue(0));
        $this->alterColumn('employee', 'salary', $this->integer()->defaultValue(0));
        $this->alterColumn('employee', 'finished_number', $this->integer()->defaultValue(0));
    }

    public function down()
    {
    }
}
