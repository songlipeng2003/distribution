<?php

use yii\db\Migration;

class m160310_160724_create_product extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image' => $this->string(),
            'price' => $this->decimal(10, 2),
            'quantity' => $this->integer(),
            'saledNumber' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger(),
            'content' => $this->text(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('product');
    }
}
