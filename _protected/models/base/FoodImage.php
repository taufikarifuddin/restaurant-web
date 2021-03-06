<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "food_image".
 *
 * @property integer $id
 * @property integer $food_id
 * @property string $img
 *
 * @property \app\models\Food $food
 */
class FoodImage extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'food'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['food_id', 'img'], 'required'],
            [['food_id'], 'integer'],
            [['img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_image';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_id' => 'Food ID',
            'img' => 'Img',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(\app\models\Food::className(), ['id' => 'food_id']);
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
     * @return \app\models\FoodImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\FoodImageQuery(get_called_class());
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
