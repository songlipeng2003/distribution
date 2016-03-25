<?php

use yii\db\Migration;

class m160315_163536_create_weixin_menu extends Migration
{
    public function up()
    {
        $this->createTable('weixinMenu', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->string(),
            'parentId' => $this->integer(),
            'key' => $this->string(),
            'url' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('weixinMenu');
    }
}
