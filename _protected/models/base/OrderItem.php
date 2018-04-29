<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "order_item".
 *
 * @property integer $id
 * @property integer $food_id
 * @property integer $qty
 * @property string $note
 * @property integer $approved
 * @property integer $order_id
 *
 * @property \app\models\Food $food
 * @property \app\models\Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'food',
            'order'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['food_id', 'qty', 'order_id'], 'integer'],
            [['qty', 'note', 'order_id'], 'required'],
            [['note'], 'string'],
            [['approved'], 'string', 'max' => 1],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_id' => 'Food ID',
            'qty' => 'Qty',
            'note' => 'Note',
            'approved' => 'Approved',
            'order_id' => 'Order ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(\app\models\Food::className(), ['id' => 'food_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(\app\models\Order::className(), ['id' => 'order_id']);
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
     * @return \app\models\OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\OrderItemQuery(get_called_class());
    }
}
