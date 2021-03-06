<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m180331_035757_category_table
 */
class m180331_035757_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180331_035757_category_table cannot be reverted.\n";

        return false;
    }
    */
}
