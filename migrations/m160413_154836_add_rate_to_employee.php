<?php

use yii\db\Migration;

class m160413_154836_add_rate_to_employee extends Migration
{
    public function up()
    {
        $this->addColumn('employee', 'rate', $this->integer()->defaultValue(30));
    }

    public function down()
    {
        $this->dropColumn('employee', 'rate');
    }
}
