<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * OrderForm model for checkout
 */
class OrderForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $delivery_method;
    public $payment_method;
    public $comment;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address', 'delivery_method', 'payment_method'], 'required'],
            [['name', 'email', 'phone', 'address', 'comment'], 'string'],
            [['delivery_method', 'payment_method'], 'string'],
            [['email'], 'email'],
            [['phone'], 'match', 'pattern' => '/^\+7\s?\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/', 'message' => 'Формат телефона: +7 (999) 999-99-99'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес доставки',
            'delivery_method' => 'Способ доставки',
            'payment_method' => 'Способ оплаты',
            'comment' => 'Комментарий',
        ];
    }

    public function getDeliveryOptions()
    {
        return [
            'courier' => 'Курьерская доставка',
            'pickup' => 'Самовывоз',
            'post' => 'Почта России',
        ];
    }

    public function getPaymentOptions()
    {
        return [
            'cash' => 'Наличными при получении',
            'card' => 'Банковской картой',
            'online' => 'Онлайн оплата',
        ];
    }
}