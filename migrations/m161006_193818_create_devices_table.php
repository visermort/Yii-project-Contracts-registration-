<?php

use yii\db\Migration;

/**
 * Handles the creation for table `devices`.
 */
class m161006_193818_create_devices_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('devices', [
            'id' => $this->primaryKey(),
            'model' => $this->string(50)->notNull(),
            'emai' => $this->string(50)->notNull()->unique(),
            'manufacturer' => $this->string(50),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('devices');
    }
}
