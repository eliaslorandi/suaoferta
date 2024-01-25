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
            'user_id' => $this->integer()->notNull(),
            'nome' => $this->string(100)->notNull(),
            'descricao' => $this->text(),
        ]);

        // Adiciona o índice na coluna user_id
        $this->createIndex(
            'idx-oferta-user_id',
            '{{%oferta}}',
            'user_id'
        );

        // Adiciona a chave estrangeira
        $this->addForeignKey(
            'fk-oferta-user_id',
            '{{%oferta}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove a chave estrangeira
        $this->dropForeignKey('fk-oferta-user_id', '{{%oferta}}');
        $this->dropTable('{{%oferta}}');
    }
}
