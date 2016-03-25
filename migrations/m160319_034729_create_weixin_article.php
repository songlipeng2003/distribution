<?php

use yii\db\Migration;

class m160319_034729_create_weixin_article extends Migration
{
    public function up()
    {
        $this->createTable('weixinArticle', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'title' => $this->string(),
            'cover' => $this->string(),
            'description' => $this->string(),
            'link' => $this->string(),
            'content' => $this->text(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('weixinArticle');
    }
}
