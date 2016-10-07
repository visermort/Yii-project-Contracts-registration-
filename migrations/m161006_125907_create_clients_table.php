<?php

use yii\db\Migration;

/**
 * Handles the creation for table `clients`.
 */
class m161006_125907_create_clients_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->unique(),
            'birth' => $this->date(),
            'passport' =>$this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('clients');
    }
}
