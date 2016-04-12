<?php

use yii\db\Migration;

class m160412_154741_change_amount_to_trading_record extends Migration
{
    public function up()
    {
        $this->alterColumn('tradingRecord', 'amount', $this->decimal(10, 2));
    }

    public function down()
    {
        $this->alterColumn('tradingRecord', 'amount', $this->string());

        return true;
    }
}
