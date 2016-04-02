<?php

use yii\db\Migration;

class m160328_163329_add_levels_number_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'level1Number', $this->integer()->defaultValue(0));
        $this->addColumn('user', 'level2Number', $this->integer()->defaultValue(0));
        $this->addColumn('user', 'level3Number', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('user', 'level1Number');
        $this->dropColumn('user', 'level2Number');
        $this->dropColumn('user', 'level3Number');
        return true;
    }
}
