<?php

use yii\db\Migration;

class m160319_051820_create_weixin_user extends Migration
{
    public function up()
    {
        $this->createTable('weixinUser', [
            'id' => $this->primaryKey(),
            'openid' => $this->string(),
            'username' => $this->string(),
            'nickname' => $this->string(),
            'city' => $this->string(),
            'avatar' => $this->string(),
            'language' => $this->string(),
            'city' => $this->string(),
            'province' => $this->string(),
            'country' => $this->string(),
            'remark' => $this->string(),
            'groupId' => $this->string(),
            'subscribeTime' => $this->dateTime(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
            'lastLoginedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('weixinUser');
    }
}
