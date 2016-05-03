<?php

use yii\db\Migration;

class m160503_142723_create_news extends Migration
{
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'author' => $this->string(),
            'url' => $this->string(),
            'content' => $this->text(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
    }
}
