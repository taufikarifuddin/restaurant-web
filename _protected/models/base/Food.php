<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "food".
 *
 * @property integer $id
 * @property string $name
 * @property string $detail
 * @property integer $price
 * @property integer $category
 * @property integer $status
 *
 * @property \app\models\FoodCategory $category0
 * @property \app\models\FoodImage[] $foodImages
 * @property \app\models\OrderItem[] $orderItems
 */
class Food extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'category0',
            'foodImages',
            'orderItems'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'detail', 'price'], 'required'],
            [['detail'], 'string'],
            [['price', 'category'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'detail' => 'Detail',
            'price' => 'Price',
            'category' => 'Category',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(\app\models\FoodCategory::className(), ['id' => 'category']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoodImages()
    {
        return $this->hasMany(\app\models\FoodImage::className(), ['food_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(\app\models\OrderItem::className(), ['food_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\FoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\FoodQuery(get_called_class());
    }
}
