<?php

use yii\db\Migration;

class m160416_095333_change_setting extends Migration
{
    public function up()
    {
        $this->alterColumn('Setting', 'value', $this->text());
    }

    public function down()
    {
        $this->alterColumn('Setting', 'value', $this->string());

        return true;
    }
}
