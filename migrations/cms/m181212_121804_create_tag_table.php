<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 */
class m181212_121804_create_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(11),
            'title' => $this->string()->notNull(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tag');
    }
}
