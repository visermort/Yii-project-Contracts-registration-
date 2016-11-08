<?php

use yii\db\Migration;
use app\models\User;

class m161024_142929_update_contracts_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%contracts}}', 'id_user', $this->integer(11)->notNull());


        $this->execute('update {{%contracts}} set `id_user` = (select `id` from {{%user}} where `username` = `sale_point`)');


    }

    public function down()
    {
        $this->dropColumn('{{%contracts}}', 'id_user');
    }


}
