<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[UserWorkStory]].
 *
 * @see UserWorkStory
 */
class UserWorkStoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserWorkStory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserWorkStory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
