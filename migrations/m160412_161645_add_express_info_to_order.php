<?php

use yii\db\Migration;

class m160412_161645_add_express_info_to_order extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'expressId', $this->integer());
        $this->addColumn('order', 'expressSn', $this->integer());
        $this->addColumn('order', 'sendedAt', $this->dateTime());

        $this->createIndex('index_user', 'order', ['userId'], false);
    }

    public function down()
    {
        $this->dropIndex('index_user', 'order');

        $this->dropColumn('order', 'expressId');
        $this->dropColumn('order', 'expressSn');
        $this->dropColumn('order', 'sendedAt');
    }
}
