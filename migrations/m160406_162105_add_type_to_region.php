<?php

use yii\db\Migration;

class m160406_162105_add_type_to_region extends Migration
{
    public function up()
    {
        $this->addColumn('region', 'type', $this->string());
    }

    public function down()
    {
        $this->dropColumn('region', 'type');
    }
}
