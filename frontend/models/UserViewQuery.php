<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[UserView]].
 *
 * @see UserView
 */
class UserViewQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserView[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserView|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
