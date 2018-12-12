<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Apikey]].
 *
 * @see Apikey
 */
class ApikeyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Apikey[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Apikey|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
