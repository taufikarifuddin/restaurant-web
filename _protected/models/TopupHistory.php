<?php

namespace app\models;

use Yii;
use \app\models\base\TopupHistory as BaseTopupHistory;

/**
 * This is the model class for table "topup_history".
 */
class TopupHistory extends BaseTopupHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'nominal'], 'integer'],
            [['nominal'], 'required'],
            [['topup_date'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
