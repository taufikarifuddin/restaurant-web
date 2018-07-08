<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SeatTable]].
 *
 * @see SeatTable
 */
class SeatTableQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SeatTable[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SeatTable|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
