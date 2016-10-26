<?php

use yii\db\Migration;

class m161026_055459_update_contracts_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%contracts}}', 'date_create', 'timestamp default current_timestamp');
    }

    public function down()
    {
        $this->dropColumn('{{%contracts}}', 'date_create');

    }


}
