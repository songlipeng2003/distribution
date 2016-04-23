<?php

use yii\db\Migration;

class m160416_100125_add_user_type_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'userType', $this->smallInteger()->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('user', 'userType');
    }
}
