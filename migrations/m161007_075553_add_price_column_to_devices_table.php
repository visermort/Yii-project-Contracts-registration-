<?php

use yii\db\Migration;

/**
 * Handles adding price to table `devices`.
 */
class m161007_075553_add_price_column_to_devices_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('devices', 'price', $this->decimal(10,2)->notNull());

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('devices', 'price');
    }
}
