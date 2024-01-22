<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comercio_login}}`.
 */
class m240122_115247_create_comercio_login_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comercio_login}}', [
            'id' => $this->primaryKey(),
            'nome_comercio' => $this->string(100)->notNull(),
            'username' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'senha' => $this->string(100)->notNull(),
            'telefone' => $this->string(20)->notNull(),
            'auth_key' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comercio_login}}');
    }
}
