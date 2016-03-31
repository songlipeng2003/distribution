<?php

use yii\db\Migration;

class m160331_151941_add_user_id_to_order extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'userId', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('order', 'userId');
    }
}
