<?php

use yii\db\Migration;

class m160402_083915_add_status_to_extract extends Migration
{
    public function up()
    {
        $this->addColumn('extract', 'status', $this->smallInteger()->defaultValue(1));
        $this->addColumn('extract', 'weixinRedEnvelope', $this->string());
        $this->addColumn('extract', 'transactionNo', $this->string());
    }

    public function down()
    {
        $this->dropColumn('extract', 'status');
        $this->dropColumn('extract', 'weixinRedEnvelope');
        $this->dropColumn('extract', 'transactionNo');

        return true;
    }
}
