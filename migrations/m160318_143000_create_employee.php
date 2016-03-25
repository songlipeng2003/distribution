<?php

use yii\db\Migration;

class m160318_143000_create_employee extends Migration
{
    public function up()
    {
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'token' => $this->string(),
            'status' => $this->smallInteger(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
            'lastLoginedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('employee');
    }
}
