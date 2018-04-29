<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TopupHistory]].
 *
 * @see TopupHistory
 */
class TopupHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TopupHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TopupHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
