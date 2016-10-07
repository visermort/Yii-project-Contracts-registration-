<?php

use yii\db\Migration;

/**
 * Handles the creation for table `contracts`.
 */
class m161007_083641_create_contracts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('contracts', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'client_id' => $this->integer()->notNull(),
            'device_id' => $this->integer()->notNull(),
            'summa' => $this->decimal(10,2)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contracts');
    }
}
