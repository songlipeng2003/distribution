<?php

use yii\db\Migration;

class m160406_142721_create_region extends Migration
{
    public function up()
    {
        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string(),
            'lft' => $this->integer(),
            'rgt' => $this->integer(),
            'level' => $this->integer(),
            'root' => $this->integer(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('region');
    }
}
