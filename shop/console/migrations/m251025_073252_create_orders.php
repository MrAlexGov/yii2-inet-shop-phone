<?php

use yii\db\Migration;

class m251025_073252_create_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->string(50)->defaultValue('pending'),
            'total_amount' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-orders-user_id',
            '{{%orders}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-orders-user_id',
            '{{%orders}}',
            'user_id'
        );

        $this->createIndex(
            'idx-orders-status',
            '{{%orders}}',
            'status'
        );

        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-order_items-order_id',
            '{{%order_items}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order_items-product_id',
            '{{%order_items}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-order_items-order_id',
            '{{%order_items}}',
            'order_id'
        );

        $this->createIndex(
            'idx-order_items-product_id',
            '{{%order_items}}',
            'product_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order_items-order_id', '{{%order_items}}');
        $this->dropForeignKey('fk-order_items-product_id', '{{%order_items}}');
        $this->dropIndex('idx-order_items-order_id', '{{%order_items}}');
        $this->dropIndex('idx-order_items-product_id', '{{%order_items}}');
        $this->dropTable('{{%order_items}}');

        $this->dropForeignKey('fk-orders-user_id', '{{%orders}}');
        $this->dropIndex('idx-orders-user_id', '{{%orders}}');
        $this->dropIndex('idx-orders-status', '{{%orders}}');
        $this->dropTable('{{%orders}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251025_073252_create_orders cannot be reverted.\n";

        return false;
    }
    */
}
