<?php

use yii\db\Migration;

class m160321_134840_create_address extends Migration
{
    public function up()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'provinceId' => $this->integer(),
            'cityId' => $this->integer(),
            'regionId' => $this->integer(),
            'address' => $this->string(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
        ]);

        $this->createIndex('userId', 'address', 'userId');
    }

    public function down()
    {
        $this->dropIndex('userId', 'address');
        $this->dropTable('address');
    }
}
