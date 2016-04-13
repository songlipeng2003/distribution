<?php

use yii\db\Migration;

class m160413_153548_add_month_limit_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'monthLimit', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('user', 'monthLimit');
    }
}
