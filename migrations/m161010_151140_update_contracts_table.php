<?php

use yii\db\Migration;

class m161010_151140_update_contracts_table extends Migration
{
    public function up()
    {
        $this->addColumn('contracts', 'percent', $this->string(32)->notNull());
    }

    public function down()
    {
        $this->dropColumn('contracts', 'percent');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
