<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%oferta}}`.
 */
class m240119_172158_create_oferta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%oferta}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(100)->notNull(),
            'descricao' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%oferta}}');
    }
}
