<?php

namespace app\models;

use Yii;
use \app\models\base\OrderItem as BaseOrderItem;

/**
 * This is the model class for table "order_item".
 */
class OrderItem extends BaseOrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['food_id', 'qty', 'order_id'], 'integer'],
            [['qty', 'order_id'], 'required'],
            [['note'], 'string'],
            [['approved'], 'boolean'],
        ]);
    }
	
}
