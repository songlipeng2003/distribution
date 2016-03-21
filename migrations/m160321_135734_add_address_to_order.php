<?php

use yii\db\Migration;

class m160321_135734_add_address_to_order extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'provinceId', $this->integer());
        $this->addColumn('order', 'cityId', $this->integer());
        $this->addColumn('order', 'regionId', $this->integer());
        $this->addColumn('order', 'address', $this->integer());
        $this->addColumn('order', 'name', $this->integer());
        $this->addColumn('order', 'phone', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('order', 'provinceId');
        $this->dropColumn('order', 'cityId');
        $this->dropColumn('order', 'regionId');
        $this->dropColumn('order', 'address');
        $this->dropColumn('order', 'name');
        $this->dropColumn('order', 'phone');
    }
}
