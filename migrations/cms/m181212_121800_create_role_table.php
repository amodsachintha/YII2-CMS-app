<?php

use yii\db\Migration;

/**
 * Handles the creation of table `role`.
 */
class m181212_121800_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(191)->notNull(),
            'description' => $this->string(191),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('role');
    }
}
