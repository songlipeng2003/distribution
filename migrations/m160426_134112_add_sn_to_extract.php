<?php

use yii\db\Migration;

class m160426_134112_add_sn_to_extract extends Migration
{
    public function up()
    {
        $this->addColumn('extract', 'sn', $this->string());
    }

    public function down()
    {
        $this->dropColumn('extract', 'sn');
    }
}
