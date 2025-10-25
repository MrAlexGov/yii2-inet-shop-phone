<?php

use yii\db\Migration;

class m251025_073329_create_attributes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attributes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'type' => $this->string(50)->notNull(), // string, integer, decimal, boolean
            'required' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            'idx-attributes-type',
            '{{%attributes}}',
            'type'
        );

        $this->createTable('{{%product_attributes}}', [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'value' => $this->text(),
        ]);

        $this->addPrimaryKey('pk-product_attributes', '{{%product_attributes}}', ['product_id', 'attribute_id']);

        $this->addForeignKey(
            'fk-product_attributes-product_id',
            '{{%product_attributes}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-product_attributes-attribute_id',
            '{{%product_attributes}}',
            'attribute_id',
            '{{%attributes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product_attributes-product_id',
            '{{%product_attributes}}',
            'product_id'
        );

        $this->createIndex(
            'idx-product_attributes-attribute_id',
            '{{%product_attributes}}',
            'attribute_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product_attributes-product_id', '{{%product_attributes}}');
        $this->dropForeignKey('fk-product_attributes-attribute_id', '{{%product_attributes}}');
        $this->dropIndex('idx-product_attributes-product_id', '{{%product_attributes}}');
        $this->dropIndex('idx-product_attributes-attribute_id', '{{%product_attributes}}');
        $this->dropTable('{{%product_attributes}}');

        $this->dropIndex('idx-attributes-type', '{{%attributes}}');
        $this->dropTable('{{%attributes}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251025_073329_create_attributes cannot be reverted.\n";

        return false;
    }
    */
}
