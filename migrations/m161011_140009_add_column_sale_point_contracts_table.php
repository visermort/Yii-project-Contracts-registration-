<?php

use yii\db\Migration;

class m161011_140009_add_column_sale_point_contracts_table extends Migration
{
    public function up()
    {
         $this->addColumn('contracts', 'sale_point', $this->string(64)->notNull());
    }

    public function down()
    {
         $this->dropColumn('contracts', 'sale_point');
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
