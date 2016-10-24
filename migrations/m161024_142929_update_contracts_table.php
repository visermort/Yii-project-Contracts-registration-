<?php

use yii\db\Migration;

class m161024_142929_update_contracts_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%contracts}}', 'id_user', $this->integer(11)->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%contracts}}', 'id_user');
    }


}
