<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "food_category".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $is_food
 *
 * @property \app\models\Food[] $foods
 */
class FoodCategory extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'foods'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'is_food'], 'required'],
            [['name'], 'string','max' => 255],
            [['is_food'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_category';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_food' => 'Is Food',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoods()
    {
        return $this->hasMany(\app\models\Food::className(), ['category' => 'id']);
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
     * @return \app\models\FoodCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\FoodCategoryQuery(get_called_class());
    }
}
