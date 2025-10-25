<?php

use yii\db\Migration;

class m251025_073138_create_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'price' => $this->decimal(10, 2)->notNull(),
            'old_price' => $this->decimal(10, 2)->null(),
            'description' => $this->text(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-products-category_id',
            '{{%products}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-brand_id',
            '{{%products}}',
            'brand_id',
            '{{%brands}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-products-category_id',
            '{{%products}}',
            'category_id'
        );

        $this->createIndex(
            'idx-products-brand_id',
            '{{%products}}',
            'brand_id'
        );

        $this->createIndex(
            'idx-products-status',
            '{{%products}}',
            'status'
        );

        $this->createIndex(
            'idx-products-price',
            '{{%products}}',
            'price'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products-category_id', '{{%products}}');
        $this->dropForeignKey('fk-products-brand_id', '{{%products}}');
        $this->dropIndex('idx-products-category_id', '{{%products}}');
        $this->dropIndex('idx-products-brand_id', '{{%products}}');
        $this->dropIndex('idx-products-status', '{{%products}}');
        $this->dropIndex('idx-products-price', '{{%products}}');
        $this->dropTable('{{%products}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251025_073138_create_products cannot be reverted.\n";

        return false;
    }
    */
}
