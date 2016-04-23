<?php

use yii\db\Migration;

class m160421_145525_add_poster_and_poster_gen_at_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'poster', $this->string());
        $this->addColumn('user', 'posterAt', $this->dateTime());
    }

    public function down()
    {
        $this->dropColumn('user', 'poster');
        $this->dropColumn('user', 'posterAt');
    }
}
