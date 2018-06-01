<?php

namespace app\models;

use Yii;
use \app\models\base\Food as BaseFood;

/**
 * This is the model class for table "food".
 */
class Food extends BaseFood
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'detail', 'price'], 'required'],
            [['detail'], 'string'],
            [['price', 'category'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'boolean'],
        ]);
    }
	
}
