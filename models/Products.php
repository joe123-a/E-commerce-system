<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use app\models\Categories;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property int $category_id
 * @property string|null $description
 * @property float $price
 * @property float|null $discount_price
 * @property string|null $image_path
 * @property float|null $rating
 * @property bool|null $is_new
 * @property bool|null $is_sale
 * @property bool|null $is_featured
 * @property bool|null $is_top_selling
 * @property int $stock_quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property UploadedFile $imageFile
 */
class Products extends ActiveRecord
{
    public $imageFile;

    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['name', 'model', 'category_id', 'price', 'stock_quantity'], 'required'],
            [['description'], 'string'],
            [['price', 'discount_price', 'rating'], 'number', 'min' => 0],
            [['rating'], 'number', 'max' => 5],
            [['category_id', 'stock_quantity'], 'integer', 'min' => 0],
            [['is_new', 'is_sale', 'is_featured', 'is_top_selling'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_path'], 'string', 'max' => 255],
            [['model'], 'string', 'max' => 100],
            [['discount_price', 'image_path'], 'default', 'value' => null],
            [['rating'], 'default', 'value' => 0.0],
            [['imageFile'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'maxSize' => 1024 * 1024 * 2], // 2MB max
            [['category_id'], 'exist', 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Product Name',
            'model' => 'Model Number',
            'category_id' => 'Category',
            'description' => 'Description',
            'price' => 'Price ($)',
            'discount_price' => 'Discount Price ($)',
            'image_path' => 'Image Path',
            'imageFile' => 'Product Image',
            'rating' => 'Rating',
            'is_new' => 'New Arrival',
            'is_sale' => 'On Sale',
            'is_featured' => 'Is Featured',
            'is_top_selling' => 'Top Selling',
            'stock_quantity' => 'Stock Quantity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }
    
}