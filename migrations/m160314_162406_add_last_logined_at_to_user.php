<?php

use yii\db\Migration;

class m160314_162406_add_last_logined_at_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'lastLoginedAt', $this->dateTime());
    }

    public function down()
    {
        $this->dropColumn('user', 'lastLoginedAt');
    }
}
