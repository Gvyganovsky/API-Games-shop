<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Games extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|null
     */
    public $imageFile;

    /**
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
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
