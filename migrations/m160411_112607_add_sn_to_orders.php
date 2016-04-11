<?php

use yii\db\Migration;

class m160411_112607_add_sn_to_orders extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'sn', $this->string());
    }

    public function down()
    {
        $this->dropColumn('order', 'sn');
    }
}
