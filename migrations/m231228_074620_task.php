<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m231228_074620_task
 */
class m231228_074620_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('Users', [
            'id' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'created' => Schema::TYPE_TIMESTAMP,
        ]);

        $this->createTable('Goods', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created' => Schema::TYPE_TIMESTAMP,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231228_074620_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231228_074620_task cannot be reverted.\n";

        return false;
    }
    */
}
