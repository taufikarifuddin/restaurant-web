<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "booking".
 *
 * @property integer $id
 * @property integer $no_meja
 * @property integer $user_id
 * @property string $starttime
 * @property string $endtime
 * @property integer $is_available
 *
 * @property \app\models\SeatTable $noMeja
 * @property \app\models\User $user
 */
class Booking extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'noMeja',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_meja', 'user_id', 'starttime', 'endtime'], 'required'],
            [['no_meja', 'user_id', 'starttime', 'endtime'], 'integer'],
            [['is_available'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_meja' => 'No Meja',
            'user_id' => 'User ID',
            'starttime' => 'Starttime',
            'endtime' => 'Endtime',
            'is_available' => 'Is Available',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoMeja()
    {
        return $this->hasOne(\app\models\SeatTable::className(), ['id' => 'no_meja']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\BookingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\BookingQuery(get_called_class());
    }
}
