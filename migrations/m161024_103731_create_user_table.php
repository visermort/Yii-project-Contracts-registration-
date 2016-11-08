ye<?php

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
            'name' => $this->string()->notNull()->unique(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
          //  'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role' => $this->smallInteger()->notNull()->defaultValue(10),
        
        ], $tableOptions);
     }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}