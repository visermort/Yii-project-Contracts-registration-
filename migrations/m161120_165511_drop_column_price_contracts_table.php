<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `column_price_contracts`.
 */
class m161120_165511_drop_column_price_contracts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%contracts}}', 'percent');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%contracts}}', 'percent', $this->decimal(10,2)->notNull());   
    }
}
