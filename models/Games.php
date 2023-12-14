<?php

namespace app\models;

use Yii;
<<<<<<< HEAD

/**
 * This is the model class for table "games".
 *
 * @property int $id_game
 * @property string $game_name
 * @property float $price
 * @property int|null $category_id
 * @property string|null $description
 * @property string|null $image
 *
 * @property Category $category
 * @property Orders[] $orders
 */
class Games extends \yii\db\ActiveRecord
{
    /**
=======
use yii\web\UploadedFile;

class Games extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|null
     */
    public $imageFile;

    /**
>>>>>>> master
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_name', 'price', 'category_id'], 'required'],
            [['price'], 'number', 'numberPattern' => '/^\d+(\.\d{1,2})?$/'],
            [['category_id'], 'integer'],
            [['description'], 'string'],
            [['game_name'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 255],
<<<<<<< HEAD
=======
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
>>>>>>> master
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id_category']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_game' => 'Id Game',
            'game_name' => 'Game Name',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id_category' => 'category_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['game_id' => 'id_game']);
    }
}
