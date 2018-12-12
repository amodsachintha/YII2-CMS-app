<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 * Has foreign keys to the tables:
 *
 * - `role`
 */
class m181212_121802_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(11),
            'role_id' => $this->integer(11)->notNull(),
            'email' => $this->string(191)->notNull()->unique(),
            'password' => $this->string(191)->notNull(),
            'name' => $this->string(191)->notNull(),
            'auth_key' => $this->string(191)->notNull(),
            'access_token' => $this->string(191)->notNull(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');

        // creates index for column `role_id`
        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );

        // add foreign key for table `role`
        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `role`
        $this->dropForeignKey(
            'fk-user-role_id',
            'user'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            'idx-user-role_id',
            'user'
        );

        $this->dropTable('user');
    }
}
