<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%arquivo}}`.
 */
class m240119_172319_create_arquivo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%arquivo}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(100)->notNull(),
            'base_url' => $this->string()->notNull(),
            'mime_type' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%arquivo}}');
    }
}
