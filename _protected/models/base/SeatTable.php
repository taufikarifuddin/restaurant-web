<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "seat_table".
 *
 * @property integer $id
 * @property integer $seat_table_number
 * @property integer $user_id
 *
 * @property \app\models\User $user
 */
class SeatTable extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seat_table_number'], 'required'],
            [['id', 'seat_table_number', 'user_id'], 'integer'],
            [['seat_table_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seat_table';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seat_table_number' => 'Seat Table Number',
            'user_id' => 'User ID',
        ];
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
     * @return \app\models\SeatTableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\SeatTableQuery(get_called_class());
    }
}
