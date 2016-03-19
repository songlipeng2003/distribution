<?php

use yii\db\Migration;

class m160319_075603_add_count_weixi_group extends Migration
{
    public function up()
    {
        $this->addColumn('weixinGroup', 'count', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('weixinGroup', 'count');

        return true;
    }
}
