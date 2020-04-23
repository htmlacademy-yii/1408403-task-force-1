<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_work_story".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $attachment_path
 *
 * @property User $user
 */
class UserWorkStory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_work_story';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['attachment_path'], 'string', 'max' => 255],
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
            'attachment_path' => 'Attachment Path',
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
     * @return UserWorkStoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserWorkStoryQuery(get_called_class());
    }
}
