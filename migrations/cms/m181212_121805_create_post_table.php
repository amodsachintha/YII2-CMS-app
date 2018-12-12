<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `user`
 */
class m181212_121805_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(11),
            'category_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'title' => $this->string(191)->notNull(),
            'content' => $this->text(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');

        // creates index for column `category_id`
        $this->createIndex(
            'idx-post-category_id',
            'post',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-post-category_id',
            'post',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-user_id',
            'post',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user_id',
            'post',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-post-category_id',
            'post'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-post-category_id',
            'post'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-post-user_id',
            'post'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-post-user_id',
            'post'
        );

        $this->dropTable('post');
    }
}
