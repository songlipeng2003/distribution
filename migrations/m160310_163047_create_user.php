<?php

use yii\db\Migration;

class m160310_163047_create_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'weixin' => $this->string(),
            'parentId' => $this->integer(),
            'avatar' => $this->string(),
            'token' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
