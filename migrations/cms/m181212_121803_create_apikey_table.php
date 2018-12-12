<?php

use yii\db\Migration;

/**
 * Handles the creation of table `apikey`.
 */
class m181212_121803_create_apikey_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apikey', [
            'id' => $this->primaryKey(11),
            'key' => $this->string()->notNull(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apikey');
    }
}
