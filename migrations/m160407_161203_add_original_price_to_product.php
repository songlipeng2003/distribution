<?php

use yii\db\Migration;

class m160407_161203_add_original_price_to_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'originalPrice', $this->decimal(10, 2));
    }

    public function down()
    {
        $this->dropColumn('product', 'originalPrice');
    }
}
