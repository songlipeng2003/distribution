<?php

use yii\db\Migration;

class m160328_160707_rename_total_amount_to_orders extends Migration
{
    public function up()
    {
        $this->renameColumn('order', 'total_amount', 'totalAmount');
    }

    public function down()
    {
        $this->renameColumn('order', 'totalAmount', 'total_amount');

        return true;
    }
}
