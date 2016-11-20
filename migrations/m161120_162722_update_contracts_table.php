<?php

use yii\db\Migration;

class m161120_162722_update_contracts_table extends Migration
{
    public function up()
    {

        $this->addColumn('{{%contracts}}', 'tariff', $this->decimal(10,2));

        $this->execute('update {{%contracts}} set `tariff` = SUBSTRING(`percent`, 1, 2)');

       // $this->dropColumn('{{%contracts}}', 'percent');

    }

    public function down()
    {
        
        $this->dropColumn('{{%contracts}}', 'tariff');

        //$this->addColumn('{{%contracts}}', 'percent', $this->decimal(10,2)->notNull());   

    }


}
