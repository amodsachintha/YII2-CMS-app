<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PostTag]].
 *
 * @see PostTag
 */
class PostTagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PostTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PostTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
