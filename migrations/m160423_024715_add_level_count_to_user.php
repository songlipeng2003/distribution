<?php

use yii\db\Migration;

class m160423_024715_add_level_count_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'level1Count', $this->decimal(10, 2)->defaultValue(0.0));
        $this->addColumn('user', 'level2Count', $this->decimal(10, 2)->defaultValue(0.0));
        $this->addColumn('user', 'level3Count', $this->decimal(10, 2)->defaultValue(0.0));
    }

    public function down()
    {
        $this->dropColumn('user', 'level1Count');
        $this->dropColumn('user', 'level2Count');
        $this->dropColumn('user', 'level3Count');
    }
}
