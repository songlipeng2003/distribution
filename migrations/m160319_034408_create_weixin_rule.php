<?php

use yii\db\Migration;

class m160319_034408_create_weixin_rule extends Migration
{
    public function up()
    {
        $this->createTable('weixinRule', [
            'id' => $this->primaryKey(),
            'keyword' => $this->string(),
            'weixinArticle' => $this->integer(),
            'createdAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('weixinRule');
    }
}
