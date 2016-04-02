<?php

use yii\db\Migration;

class m160402_055719_change_weixin_user extends Migration
{
    public function up()
    {
        $this->addColumn('weixinUser', 'sex', $this->smallInteger());
        $this->addColumn('weixinUser', 'isSubscribe', $this->boolean()->defaultValue(1));
        $this->dropColumn('weixinUser', 'username');
        $this->renameColumn('weixinUser', 'lastLoginedAt', 'lastMessageAt');
        $this->alterColumn('weixinUser', 'groupId', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('weixinUser', 'sex');
        $this->dropColumn('weixinUser', 'isSubscribe');
        $this->addColumn('weixinUser', 'username', $this->string());
        $this->renameColumn('weixinUser', 'lastMessageAt', 'lastLoginedAt');
        $this->alterColumn('weixinUser', 'groupId', $this->string());

        return true;
    }
}
