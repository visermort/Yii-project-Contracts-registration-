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
        $this->createTable('{{%contracts}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'name' => $this->string(100)->notNull(),
            'passport' => $this->string(100)->notNull(),
            'phone' => $this->string(50),
            'manufacturer' => $this->string(50)->notNull(),
            'model' => $this->string(50)->notNull(),
            'imei' => $this->string(50)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'percent' => $this->string(20)->notNull(),
            'sum' => $this->integer()->notNull(),
            'sale_point' => $this->string(50)->notNull(),
         ]); 
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%contracts}}');
    }
}
