<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_view".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $user_came_id
 *
 * @property User $user
 * @property User $userCame
 */
class UserView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user_came_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_came_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_came_id' => 'id']],
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
            'user_came_id' => 'User Came ID',
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
     * Gets query for [[UserCame]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUserCame()
    {
        return $this->hasOne(User::className(), ['id' => 'user_came_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserViewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserViewQuery(get_called_class());
    }
}
