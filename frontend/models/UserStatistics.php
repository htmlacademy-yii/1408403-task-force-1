<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_statistics".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $tasks_done
 * @property int|null $tasks_failed
 * @property int|null $reviews_done
 * @property int|null $reviews_received
 * @property float|null $rating
 *
 * @property User $user
 */
class UserStatistics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_statistics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tasks_done', 'tasks_failed', 'reviews_done', 'reviews_received'], 'integer'],
            [['rating'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tasks_done' => 'Tasks Done',
            'tasks_failed' => 'Tasks Failed',
            'reviews_done' => 'Reviews Done',
            'reviews_received' => 'Reviews Received',
            'rating' => 'Rating',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserStatisticsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserStatisticsQuery(get_called_class());
    }
}
