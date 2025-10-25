<?php

use yii\db\Migration;

class m251025_073214_create_product_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_images}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image_path' => $this->string(255)->notNull(),
            'sort_order' => $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-product_images-product_id',
            '{{%product_images}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-product_images-product_id',
            '{{%product_images}}',
            'product_id'
        );

        $this->createIndex(
            'idx-product_images-sort_order',
            '{{%product_images}}',
            'sort_order'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product_images-product_id', '{{%product_images}}');
        $this->dropIndex('idx-product_images-product_id', '{{%product_images}}');
        $this->dropIndex('idx-product_images-sort_order', '{{%product_images}}');
        $this->dropTable('{{%product_images}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251025_073214_create_product_images cannot be reverted.\n";

        return false;
    }
    */
}
