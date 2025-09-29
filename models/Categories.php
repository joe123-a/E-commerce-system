<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Categories extends ActiveRecord
{
    public $product_count; 
    public static function tableName()
    {
        return 'categories';
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category Name',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Products::class, ['category_id' => 'id']);
    }

    public function getProductCount()
    {
        return $this->getProducts()->count();
    }
}