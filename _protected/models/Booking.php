<?php

namespace app\models;

use Yii;
use \app\models\base\Booking as BaseBooking;

/**
 * This is the model class for table "booking".
 */
class Booking extends BaseBooking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['no_meja', 'user_id', 'starttime', 'endtime'], 'required'],
            [['no_meja', 'user_id', 'starttime', 'endtime'], 'integer'],
            [['is_available'], 'string', 'max' => 1]
        ]);
    }
	
}
