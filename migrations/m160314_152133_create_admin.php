<?php

use yii\db\Migration;

class m160314_152133_create_admin extends Migration
{
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
            'lastLoginedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('admin');
    }
}
