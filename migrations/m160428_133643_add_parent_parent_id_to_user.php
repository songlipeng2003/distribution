<?php

use yii\db\Migration;

class m160428_133643_add_parent_parent_id_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'grandparentId', $this->string());
        $this->addColumn('user', 'level4Number', $this->integer()->defaultValue(0));
        $this->addColumn('user', 'level5Number', $this->integer()->defaultValue(0));

        $this->createIndex('index_parent_id', 'user', ['parentId']);
        $this->createIndex('index_parent_parent_id', 'user', ['grandparentId']);
        $this->createIndex('index_employee_id', 'user', ['employeeId']);
        $this->createIndex('index_weixin', 'user', ['weixin']);
    }

    public function down()
    {
        $this->dropIndex('index_parent_id', 'user');
        $this->dropIndex('index_parent_parent_id', 'user');
        $this->dropIndex('index_employee_id', 'user');
        $this->dropIndex('index_weixin', 'user');

        $this->dropColumn('user', 'grandparentId');
        $this->dropColumn('user', 'level4Number');
        $this->dropColumn('user', 'level5Number');
    }
}
