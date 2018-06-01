<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $order_time
 * @property integer $total_price
 * @property integer $is_payed
 * @property integer $step
 *
 * @property \app\models\User $user
 * @property \app\models\OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user',
            'orderItems'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'total_price','step'], 'integer'],
            [['order_time'], 'safe'],
            [['is_payed'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_time' => 'Order Time',
            'total_price' => 'Total Price',
            'is_payed' => 'Is Payed',
            'step' => 'Step',
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
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(\app\models\OrderItem::className(), ['order_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OrderQuery(get_called_class());
    }
}
