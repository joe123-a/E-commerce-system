<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public static function tableName()
    {
        return 'cart';
    }

    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity', 'price'], 'required'],
            [['user_id', 'product_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['quantity'], 'default', 'value' => 1],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }
}
