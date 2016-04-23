<?php

use yii\db\Migration;

class m160423_133759_add_reply_weixin_rule extends Migration
{
    public function up()
    {
        $this->addColumn('weixinRule', 'reply', $this->string());
    }

    public function down()
    {
        $this->dropColumn('weixinRule', 'reply');
        return true;
    }
}
