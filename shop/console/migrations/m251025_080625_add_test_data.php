<?php

use yii\db\Migration;

class m251025_080625_add_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавляем категории
        $this->insert('{{%categories}}', [
            'name' => 'Смартфоны',
            'slug' => 'smartphones',
            'description' => 'Современные смартфоны от ведущих производителей',
            'status' => 1,
        ]);

        $this->insert('{{%categories}}', [
            'name' => 'Планшеты',
            'slug' => 'tablets',
            'description' => 'Планшеты для работы и развлечений',
            'status' => 1,
        ]);

        // Добавляем бренды
        $this->insert('{{%brands}}', [
            'name' => 'Apple',
            'slug' => 'apple',
            'description' => 'Продукция компании Apple',
            'status' => 1,
        ]);

        $this->insert('{{%brands}}', [
            'name' => 'Samsung',
            'slug' => 'samsung',
            'description' => 'Электроника от Samsung',
            'status' => 1,
        ]);

        $this->insert('{{%brands}}', [
            'name' => 'Xiaomi',
            'slug' => 'xiaomi',
            'description' => 'Смартфоны и гаджеты Xiaomi',
            'status' => 1,
        ]);

        // Добавляем товары
        $this->insert('{{%products}}', [
            'category_id' => 1,
            'brand_id' => 1,
            'name' => 'iPhone 15 Pro',
            'slug' => 'iphone-15-pro',
            'price' => 99900.00,
            'old_price' => 109900.00,
            'description' => 'Флагманский смартфон от Apple с титановым корпусом и мощным процессором A17 Pro.',
            'status' => 1,
        ]);

        $this->insert('{{%products}}', [
            'category_id' => 1,
            'brand_id' => 2,
            'name' => 'Samsung Galaxy S24',
            'slug' => 'samsung-galaxy-s24',
            'price' => 79900.00,
            'description' => 'Флагман от Samsung с инновационной камерой и большим экраном.',
            'status' => 1,
        ]);

        $this->insert('{{%products}}', [
            'category_id' => 1,
            'brand_id' => 3,
            'name' => 'Xiaomi 14',
            'slug' => 'xiaomi-14',
            'price' => 59900.00,
            'old_price' => 69900.00,
            'description' => 'Смартфон Xiaomi с отличным соотношением цены и качества.',
            'status' => 1,
        ]);

        $this->insert('{{%products}}', [
            'category_id' => 2,
            'brand_id' => 1,
            'name' => 'iPad Pro 12.9"',
            'slug' => 'ipad-pro-12-9',
            'price' => 89900.00,
            'description' => 'Профессиональный планшет Apple с M2 процессором.',
            'status' => 1,
        ]);

        // Добавляем изображения товаров
        $this->insert('{{%product_images}}', [
            'product_id' => 1,
            'image_path' => 'iphone-15-pro-1.jpg',
            'sort_order' => 0,
        ]);

        $this->insert('{{%product_images}}', [
            'product_id' => 1,
            'image_path' => 'iphone-15-pro-2.jpg',
            'sort_order' => 1,
        ]);

        $this->insert('{{%product_images}}', [
            'product_id' => 2,
            'image_path' => 'galaxy-s24-1.jpg',
            'sort_order' => 0,
        ]);

        // Добавляем характеристики
        $this->insert('{{%attributes}}', [
            'name' => 'Объем памяти',
            'type' => 'string',
            'required' => 0,
        ]);

        $this->insert('{{%attributes}}', [
            'name' => 'Цвет',
            'type' => 'string',
            'required' => 0,
        ]);

        $this->insert('{{%product_attributes}}', [
            'product_id' => 1,
            'attribute_id' => 1,
            'value' => '256GB',
        ]);

        $this->insert('{{%product_attributes}}', [
            'product_id' => 1,
            'attribute_id' => 2,
            'value' => 'Титановый',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%product_attributes}}', ['product_id' => [1, 2, 3, 4]]);
        $this->delete('{{%attributes}}', ['id' => [1, 2]]);
        $this->delete('{{%product_images}}', ['product_id' => [1, 2]]);
        $this->delete('{{%products}}', ['id' => [1, 2, 3, 4]]);
        $this->delete('{{%brands}}', ['id' => [1, 2, 3]]);
        $this->delete('{{%categories}}', ['id' => [1, 2]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251025_080625_add_test_data cannot be reverted.\n";

        return false;
    }
    */
}
