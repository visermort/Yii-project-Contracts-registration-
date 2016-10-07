<?php

use yii\db\Migration;

class m161007_091209_add_foreign_key_for_contracts_table extends Migration
{
    public function up()
    {
        //on delete - no
        $this->addForeignKey(
                'fk_contracts_clients',
                'contracts',
                'client_id',
                'clients',
                'id'
            );
        $this->addForeignKey(
                'fk_contracts_devices',
                'contracts',
                'device_id',
                'devices',
                'id'
            );
    }

    public function down()
    {
        $this->dropFereingKey('fk_contracts_clients','contracts');
        $this->dropFereingKey('fk_contracts_devices','contracts');
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
