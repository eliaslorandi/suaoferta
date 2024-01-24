<?php

use yii\db\Migration;

/**
 * Class m240124_171018_add_estabelecimento_to_user_table
 */
class m240124_171018_add_estabelecimento_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'estabelecimento', $this->string()->after('username'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'estabelecimento');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240124_171018_add_estabelecimento_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
