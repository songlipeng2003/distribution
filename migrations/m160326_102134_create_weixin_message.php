<?php

use yii\db\Migration;

class m160326_102134_create_weixin_message extends Migration
{
    public function up()
    {
        $this->createTable('weixinMessage', [
            'id' => $this->primaryKey(),
            'openid' => $this->string(),
            'content' => $this->string(),
            'type' => $this->smallInteger(),
            'isReplay' => $this->boolean(),
            'createdAt' => $this->dateTime()
        ]);
    }

    public function down()
    {
        $this->dropTable('weixinMessage');
    }
}
