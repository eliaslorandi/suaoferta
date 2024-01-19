<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%imagem_oferta}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%oferta}}`
 * - `{{%arquivo}}`
 */
class m240119_173835_create_imagem_oferta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%imagem_oferta}}', [
            'id' => $this->primaryKey(),
            'oferta_id' => $this->integer()->notNull(),
            'arquivo_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `oferta_id`
        $this->createIndex(
            '{{%idx-imagem_oferta-oferta_id}}',
            '{{%imagem_oferta}}',
            'oferta_id'
        );

        // add foreign key for table `{{%oferta}}`
        $this->addForeignKey(
            '{{%fk-imagem_oferta-oferta_id}}',
            '{{%imagem_oferta}}',
            'oferta_id',
            '{{%oferta}}',
            'id',
            'CASCADE'
        );

        // creates index for column `arquivo_id`
        $this->createIndex(
            '{{%idx-imagem_oferta-arquivo_id}}',
            '{{%imagem_oferta}}',
            'arquivo_id'
        );

        // add foreign key for table `{{%arquivo}}`
        $this->addForeignKey(
            '{{%fk-imagem_oferta-arquivo_id}}',
            '{{%imagem_oferta}}',
            'arquivo_id',
            '{{%arquivo}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%oferta}}`
        $this->dropForeignKey(
            '{{%fk-imagem_oferta-oferta_id}}',
            '{{%imagem_oferta}}'
        );

        // drops index for column `oferta_id`
        $this->dropIndex(
            '{{%idx-imagem_oferta-oferta_id}}',
            '{{%imagem_oferta}}'
        );

        // drops foreign key for table `{{%arquivo}}`
        $this->dropForeignKey(
            '{{%fk-imagem_oferta-arquivo_id}}',
            '{{%imagem_oferta}}'
        );

        // drops index for column `arquivo_id`
        $this->dropIndex(
            '{{%idx-imagem_oferta-arquivo_id}}',
            '{{%imagem_oferta}}'
        );

        $this->dropTable('{{%imagem_oferta}}');
    }
}
