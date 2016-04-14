<?php

use yii\db\Migration;

class m160414_155445_add_this_month_income_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'thisMonthIncome', $this->decimal(10, 2)->defaultValue(0.0));
        $this->addColumn('user', 'totalIncome', $this->decimal(10, 2)->defaultValue(0.0));
    }

    public function down()
    {
        $this->dropColumn('user', 'thisMonthIncome');
        $this->dropColumn('user', 'totalIncome');
    }
}
