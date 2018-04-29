<?php

use yii\db\Migration;

/**
 * Class m180331_043539_food_table
 */
class m180331_043539_food_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('food',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->defaultValue(null),
            'price' => $this->integer()->defaultValue(0),
            'status' => $this->boolean()->defaultValue(false),
            'category_id' => $this->integer()->notNull(),                
            'food_category_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-food-category_id',
            'food',
            'category_id'
        );

        $this->addForeignKey('fk_food_category','category','category_id','id', 'RESTRICT', 'CASCADE');            

        $this->createIndex(
            'idx-food-food_category_id',
            'food',
            'food_category_id'
        );        
        $this->addForeignKey('fk_food_food_category','food_category','food_category_id','id','RESTRICT', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('food');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180331_043539_food_table cannot be reverted.\n";

        return false;
    }
    */
}
