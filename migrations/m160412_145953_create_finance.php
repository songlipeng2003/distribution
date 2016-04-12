<?php

use yii\db\Migration;

class m160412_145953_create_finance extends Migration
{
    public function up()
    {
        $this->createTable('finance', [
            'id' => $this->primaryKey(),
            'userType' => $this->smallInteger(),
            'userId' => $this->integer(),
            'balance' => $this->decimal(10, 2)->defaultValue(0.0),
            'freeze' => $this->decimal(10, 2)->defaultValue(0.0),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);

        $this->createIndex('index_user', 'finance', ['userType', 'userId'], true);
    }

    public function down()
    {
        $this->dropTable('finance');
    }
}
