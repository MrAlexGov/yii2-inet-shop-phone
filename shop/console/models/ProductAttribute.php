<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_attributes".
 *
 * @property int $product_id
 * @property int $attribute_id
 * @property string|null $value
 *
 * @property Attributes $attribute0
 * @property Products $product
 */
class ProductAttribute extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'default', 'value' => null],
            [['product_id', 'attribute_id'], 'required'],
            [['product_id', 'attribute_id'], 'integer'],
            [['value'], 'string'],
            [['product_id', 'attribute_id'], 'unique', 'targetAttribute' => ['product_id', 'attribute_id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::class, 'targetAttribute' => ['attribute_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'attribute_id' => 'Attribute ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attributes::class, ['id' => 'attribute_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

}
