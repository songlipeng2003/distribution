<?php

use yii\db\Migration;

class m160410_172230_create_trading_record extends Migration
{
    public function up()
    {
        $this->createTable('tradingRecord', [
            'id' => $this->primaryKey(),
            'sn' => $this->string(),
            'userId' => $this->integer(),
            'userType' => $this->smallInteger(),
            'tradingType' => $this->smallInteger(),
            'name' => $this->string(),
            'amount' => $this->string(),
            'startAmount' => $this->decimal(10, 2),
            'endAmount' => $this->decimal(10, 2),
            'itemType' => $this->string(),
            'itemId' => $this->integer(),
            'remark' => $this->string(),
            'createdAt' => $this->dateTime()
        ]);
    }

    public function down()
    {
        $this->dropTable('tradingRecord');
    }
}
