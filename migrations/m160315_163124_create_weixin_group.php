<?php

use yii\db\Migration;

class m160315_163124_create_weixin_group extends Migration
{
    public function up()
    {
        $this->createTable('weixinGroup', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);

        $this->execute("
            INSERT INTO `weixinGroup` (`id`, `name`, `createdAt`, `updatedAt`)
            VALUES
                (1, '黑名单', '2014-10-05 20:24:14', '0000-00-00 00:00:00'),
                (3, '未分组', '2014-10-05 20:24:14', '0000-00-00 00:00:00');");
    }

    public function down()
    {
        $this->dropTable('weixinGroup');
    }
}
