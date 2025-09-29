<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Wishlist extends ActiveRecord
{
    public static function tableName()
    {
        return 'wishlist';
    }

    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_id', 'product_id'], 'unique', 'targetAttribute' => ['user_id', 'product_id'], 'message' => 'This product is already in your wishlist.'],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }
}