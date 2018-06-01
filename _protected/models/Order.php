<?php

namespace app\models;

use Yii;
use \app\models\base\Order as BaseOrder;

/**
 * This is the model class for table "order".
 */
class Order extends BaseOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id'], 'required'],
            [['user_id', 'total_price','step'], 'integer'],
            [['order_time'], 'safe'],
            [['is_payed'], 'boolean'],
        ]);
    }
	
}
