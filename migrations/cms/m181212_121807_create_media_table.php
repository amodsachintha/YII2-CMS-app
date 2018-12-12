<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 * Has foreign keys to the tables:
 *
 * - `post`
 */
class m181212_121807_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('media', [
            'id' => $this->primaryKey(11),
            'post_id' => $this->integer(11)->notNull(),
            'url' => $this->text()->notNull(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');

        // creates index for column `post_id`
        $this->createIndex(
            'idx-media-post_id',
            'media',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-media-post_id',
            'media',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `post`
        $this->dropForeignKey(
            'fk-media-post_id',
            'media'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-media-post_id',
            'media'
        );

        $this->dropTable('media');
    }
}
