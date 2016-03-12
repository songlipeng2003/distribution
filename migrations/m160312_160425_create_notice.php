<?php

use yii\db\Migration;

class m160312_160425_create_notice extends Migration
{
    public function up()
    {
        $this->createTable('notice', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('notice');
    }
}
