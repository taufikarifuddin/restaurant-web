<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FoodImage]].
 *
 * @see FoodImage
 */
class FoodImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FoodImage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FoodImage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
