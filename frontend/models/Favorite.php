<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $favorite_user_id
 *
 * @property User $user
 * @property User $favoriteUser
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'favorite_user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['favorite_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['favorite_user_id' => 'id']],
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
            'favorite_user_id' => 'Favorite User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[FavoriteUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoriteUser()
    {
        return $this->hasOne(User::className(), ['id' => 'favorite_user_id']);
    }
}
