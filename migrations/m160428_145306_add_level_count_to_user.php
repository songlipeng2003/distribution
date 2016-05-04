<?php

use yii\db\Migration;

class m160428_145306_add_level_count_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'level4Count', $this->decimal(10, 2)->defaultValue(0));
        $this->addColumn('user', 'level5Count', $this->decimal(10, 2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('user', 'level4Count');
        $this->dropColumn('user', 'level5Count');
    }
}
