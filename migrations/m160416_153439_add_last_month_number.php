<?php

use yii\db\Migration;

class m160416_153439_add_last_month_number extends Migration
{
    public function up()
    {
        $this->addColumn('employee', 'lastMonthNumber', $this->decimal(10, 2)->defaultValue(0));
        $this->alterColumn('employee', 'finishedNumber', $this->decimal(10, 2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('employee', 'lastMonthNumber');

        return true;
    }
}
