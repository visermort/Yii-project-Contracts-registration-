<?php

use yii\db\Migration;

class m161010_150416_update_client_table extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 'phone', $this->string(32));
        $this->dropColumn('clients', 'birth');
    }

    public function down()
    {
        $this->dropColumn('clients', 'phone');
        $this->addColumn('clients', 'birth')->date();
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
