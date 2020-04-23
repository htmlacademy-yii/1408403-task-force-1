<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_settings".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $receive_new_message enables to receive notifications upon receiving new message
 * @property int|null $task_update enables to receive notifications upon task status update
 * @property int|null $receive_new_review enables to receive notifications upon receiving new review
 * @property int|null $hide_contacts hide contact from everybody except for customer
 * @property int|null $profile_hidden settings in notification enables to hide user profile
 *
 * @property User $user
 */
class UserSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'receive_new_message', 'task_update', 'receive_new_review', 'hide_contacts', 'profile_hidden'], 'integer'],
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
            'receive_new_message' => 'Receive New Message',
            'task_update' => 'Task Update',
            'receive_new_review' => 'Receive New Review',
            'hide_contacts' => 'Hide Contacts',
            'profile_hidden' => 'Profile Hidden',
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
     * @return UserSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSettingsQuery(get_called_class());
    }
}
