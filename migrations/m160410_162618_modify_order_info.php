<?php

use yii\db\Migration;

class m160410_162618_modify_order_info extends Migration
{
    public function up()
    {
        $this->alterColumn('order', 'address', $this->string());
        $this->alterColumn('order', 'phone', $this->string());
        $this->alterColumn('order', 'name', $this->string());
    }

    public function down()
    {
        return true;
    }
}
