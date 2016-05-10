<?php

use yii\db\Migration;

class m160510_064233_add_saleroom_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'totalSaleroom', $this->decimal(10, 2)->defaultValue(0.0));
        $this->addColumn('user', 'thisMonthSaleroom', $this->decimal(10, 2)->defaultValue(0.0));
    }

    public function down()
    {
        $this->dropColumn('user', 'totalSaleroom');
        $this->dropColumn('user', 'thisMonthSaleroom');
    }
}
