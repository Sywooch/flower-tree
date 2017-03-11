<?php

namespace app\modules\product\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $name
 * @property integer $categoryId
 * @property integer $price
 *
 * @property Description $description
 * @property Category $category
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'categoryId'], 'required'],
            [['categoryId', 'price'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'descriptionId' => 'Description Id',
            'descriptionUkr_Name' => 'Ukr Name',
            'descriptionRus_Name' => 'Rus Name',
            'descriptionEng_Name' => 'Eng Name',
            'categoryId' => 'Category ID',
            'categoryName' => 'Category',
            'descriptionUkr_Description' => 'Ukr Description',
            'descriptionRus_Description' => 'Rus Description',
            'descriptionEng_Description' => 'Eng Description',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescription()
    {
        return $this->hasOne(Description::className(), ['productId' => 'id']);
    }

    public function getDescriptionId()
    {
        return $this->description->id;
    }

    public function getDescriptionUkr_Name()
    {
        return $this->description->ukr_Name;
    }

    public function getDescriptionRus_Name()
    {
        return $this->description->rus_Name;
    }

    public function getDescriptionEng_Name()
    {
        return $this->description->eng_Name;
    }

    public function getDescriptionUkr_Description()
    {
        return $this->description->ukr_Description;
    }

    public function getDescriptionRus_Description()
    {
        return $this->description->rus_Description;
    }

    public function getDescriptionEng_Description()
    {
        return $this->description->eng_Description;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function getCategoryName()
    {
        return $this->category->name;
    }

    public function getMainPhoto()
    {
        if (file_exists('assets/products/id-' . $this->id . '-1.png')) {
            return Html::img('@web/assets/products/id-' . $this->id . '-1.png', ['class' => 'thumbnail img-responsive']);
        } else {
            return Html::img('@web/assets/products/no-image.png', ['class' => 'thumbnail img-responsive']);
        }
    }

    public function getMainPhotoIndex()
    {
        if (file_exists('assets/products/id-' . $this->id . '-1.png')) {
            return Html::img('@web/assets/products/id-' . $this->id . '-1.png', ['class' => 'img-responsive']);
        } else {
            return Html::img('@web/assets/products/no-image.png', ['class' => 'img-responsive']);
        }
    }

    public function getAllPhotos()
    {
        $images = [];
        $imageCount = 1;

        while (file_exists('assets/products/id-' . $this->id . '-' . $imageCount . '.png')) {
            $images[] = Html::img('@web/assets/products/id-' . $this->id . '-' . $imageCount . '.png', ['class' => 'img-responsive img-modal']);
            $imageCount++;
        }

        if ($imageCount == 1) {
            $images[] = Html::img('@web/assets/products/no-image.png', ['class' => 'img-responsive']);
        }

        return $images;
    }
}
