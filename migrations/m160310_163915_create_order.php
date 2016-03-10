<?php

use yii\db\Migration;

class m160310_163915_create_order extends Migration
{
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'productId' => $this->integer(),
            'quantity' => $this->integer(),
            'price' => $this->decimal(10, 2),
            'total_amount' => $this->decimal(10, 2),
            'status' => $this->smallInteger(),
            'remark' => $this->string(),
            'createdAt' => $this->dateTime(),
            'payedAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('order');
    }
}
