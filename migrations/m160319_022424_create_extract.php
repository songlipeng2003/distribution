<?php

use yii\db\Migration;

class m160319_022424_create_extract extends Migration
{
    public function up()
    {
        $this->createTable('extract', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'amount' => $this->integer(),
            'toAmount' => $this->integer(),
            'createdAt' => $this->dateTime(),
            'operatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('extract');
    }
}
