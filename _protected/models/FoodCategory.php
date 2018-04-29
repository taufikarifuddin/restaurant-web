<?php

namespace app\models;

use Yii;
use \app\models\base\FoodCategory as BaseFoodCategory;

/**
 * This is the model class for table "food_category".
 */
class FoodCategory extends BaseFoodCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'is_food'], 'required'],
            [['name'], 'string','max' => 255],
            [['is_food'], 'string', 'max' => 1],
        ]);
    }
	
}
