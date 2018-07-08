<?php

namespace app\models;

use Yii;
use \app\models\base\SeatTable as BaseSeatTable;

/**
 * This is the model class for table "seat_table".
 */
class SeatTable extends BaseSeatTable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'seat_table_number'], 'required'],
            [['id', 'seat_table_number', 'user_id'], 'integer'],
            [['seat_table_number'], 'unique']
        ]);
    }
	
}
