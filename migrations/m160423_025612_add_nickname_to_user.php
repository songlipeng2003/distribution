<?php

use yii\db\Migration;

class m160423_025612_add_nickname_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'nickname', $this->string());
    }

    public function down()
    {
        $this->dropColumn('user', 'nickname');
    }
}
