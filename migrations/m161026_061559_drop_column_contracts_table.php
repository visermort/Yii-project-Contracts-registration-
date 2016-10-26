<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `column_contracts`.
 */
class m161026_061559_drop_column_contracts_table extends Migration
{
    public function up()
    {
        
        $this->dropColumn('{{%contracts}}', 'sale_point');
       
    }

    public function down()
    {
         $this->addColumn('{{%contracts}}', 'sale_point', 'varchar(50)');

    }
}
