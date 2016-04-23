<?php

use yii\db\Migration;

class m160419_174925_create_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);

        $this->addColumn('product', 'categoryId', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('product', 'categoryId');

        $this->dropTable('category');
    }
}
