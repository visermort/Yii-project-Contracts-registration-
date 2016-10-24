<?php

use yii\db\Migration;

class m161024_161206_add_foreign_key_contracts_tabel extends Migration
{
    public function up()
    {

        $this->addForeignKey('fk_contract_user', '{{%contracts}}', 'id_user','{{%user}}', 'id', 'restrict');

    }

    public function down()
    {
        $this->dropForeignKey('fk_contract_user');

    }

}
