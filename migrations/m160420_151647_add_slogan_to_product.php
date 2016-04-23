<?php

use yii\db\Migration;

class m160420_151647_add_slogan_to_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'slogan', $this->string());
    }

    public function down()
    {
        $this->dropColumn('product', 'slogan');
    }
}
