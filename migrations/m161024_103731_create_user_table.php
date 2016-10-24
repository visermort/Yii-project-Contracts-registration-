<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m161024_103731_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
          //  'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'display_name' => $this->string(100)->notNull()->unique(),
         //   'created_at' => $this->integer()->notNull(),
         //   'updated_at' => $this->integer()->notNull(),
           
        ], $tableOptions);
        //$this->addPrimaryKey('idx_user_primary', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}