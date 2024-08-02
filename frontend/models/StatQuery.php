<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Stat]].
 *
 * @see Stat
 */
class StatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Stat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Stat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
