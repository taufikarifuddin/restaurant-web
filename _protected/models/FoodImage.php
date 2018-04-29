<?php

namespace app\models;

use Yii;
use \app\models\base\FoodImage as BaseFoodImage;

/**
 * This is the model class for table "food_image".
 */
class FoodImage extends BaseFoodImage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['food_id', 'img'], 'required'],
            [['food_id'], 'integer'],
            [['img'], 'string', 'max' => 255]
        ]);
    }
	
}
