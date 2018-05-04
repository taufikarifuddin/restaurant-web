<?php

use yii\db\Schema;

class m180501_150101_v1 extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('food_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'is_food' => $this->tinyint(1)->notNull(),
            ], $tableOptions);
                $this->createTable('food', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'detail' => $this->text()->notNull(),
            'price' => $this->integer(11)->notNull(),
            'category' => $this->integer(11),
            'status' => $this->tinyint(1)->defaultValue(0),
            'FOREIGN KEY ([[category]]) REFERENCES food_category ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            ], $tableOptions);
                $this->createTable('food_image', [
            'id' => $this->primaryKey(),
            'food_id' => $this->integer(11)->notNull(),
            'img' => $this->string(255)->notNull(),
            'FOREIGN KEY ([[food_id]]) REFERENCES food ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            ], $tableOptions);
                $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->defaultValue(1),
            'auth_key' => $this->string(32),
            'password_reset_token' => $this->string(255),
            'account_activation_token' => $this->string(255),
            'role' => $this->tinyint(4)->defaultValue(1),
            'current_saldo' => $this->integer(11)->defaultValue(0),
            ], $tableOptions);
                $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'order_time' => $this->datetime()->defaultValue(CURRENT_TIMESTAMP),
            'total_price' => $this->integer(11)->notNull()->defaultValue(0),
            'is_payed' => $this->tinyint(1)->defaultValue(0),
            'step' => $this->tinyint(4)->defaultValue(1),
            'FOREIGN KEY ([[user_id]]) REFERENCES user ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            ], $tableOptions);
                $this->createTable('order_item', [
            'id' => $this->primaryKey(),
            'food_id' => $this->integer(11),
            'qty' => $this->integer(11)->notNull(),
            'note' => $this->text()->notNull(),
            'approved' => $this->tinyint(1)->notNull()->defaultValue(0),
            'order_id' => $this->integer(11)->notNull(),
            'FOREIGN KEY ([[food_id]]) REFERENCES food ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[order_id]]) REFERENCES order ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            ], $tableOptions);
                $this->createTable('topup_history', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'nominal' => $this->integer(11)->notNull(),
            'topup_date' => $this->datetime()->defaultValue(CURRENT_TIMESTAMP),
            ], $tableOptions);
                
    }

    public function down()
    {
        $this->dropTable('topup_history');
        $this->dropTable('order_item');
        $this->dropTable('order');
        $this->dropTable('user');
        $this->dropTable('food_image');
        $this->dropTable('food');
        $this->dropTable('food_category');
    }
}
