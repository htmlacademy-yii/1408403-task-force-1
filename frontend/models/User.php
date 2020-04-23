<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $full_name
 * @property string|null $password SHA256 password
 * @property string|null $registration_date
 *
 * @property Favorite[] $favorites
 * @property Favorite[] $favorites0
 * @property Notification[] $notifications
 * @property Response[] $responses
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property TaskChat[] $taskChats
 * @property TaskChat[] $taskChats0
 * @property Testimonial[] $testimonials
 * @property Testimonial[] $testimonials0
 * @property UserCategory[] $userCategories
 * @property UserProfile[] $userProfiles
 * @property UserSettings[] $userSettings
 * @property UserStatistics[] $userStatistics
 * @property UserView[] $userViews
 * @property UserView[] $userViews0
 * @property UserWorkStory[] $userWorkStories
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration_date'], 'safe'],
            [['email', 'full_name', 'password'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'full_name' => 'Full Name',
            'password' => 'Password',
            'registration_date' => 'Registration Date',
        ];
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery|FavoriteQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites0]].
     *
     * @return \yii\db\ActiveQuery|FavoriteQuery
     */
    public function getFavorites0()
    {
        return $this->hasMany(Favorite::className(), ['favorite_user_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery|NotificationQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery|ResponseQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['created_by_user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['assigned_user_id' => 'id']);
    }

    /**
     * Gets query for [[TaskChats]].
     *
     * @return \yii\db\ActiveQuery|TaskChatQuery
     */
    public function getTaskChats()
    {
        return $this->hasMany(TaskChat::className(), ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[TaskChats0]].
     *
     * @return \yii\db\ActiveQuery|TaskChatQuery
     */
    public function getTaskChats0()
    {
        return $this->hasMany(TaskChat::className(), ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials]].
     *
     * @return \yii\db\ActiveQuery|TestimonialQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonial::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials0]].
     *
     * @return \yii\db\ActiveQuery|TestimonialQuery
     */
    public function getTestimonials0()
    {
        return $this->hasMany(Testimonial::className(), ['created_by_user_id' => 'id']);
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery|UserCategoryQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserProfiles]].
     *
     * @return \yii\db\ActiveQuery|UserProfileQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserSettings]].
     *
     * @return \yii\db\ActiveQuery|UserSettingsQuery
     */
    public function getUserSettings()
    {
        return $this->hasMany(UserSettings::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserStatistics]].
     *
     * @return \yii\db\ActiveQuery|UserStatisticsQuery
     */
    public function getUserStatistics()
    {
        return $this->hasMany(UserStatistics::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserViews]].
     *
     * @return \yii\db\ActiveQuery|UserViewQuery
     */
    public function getUserViews()
    {
        return $this->hasMany(UserView::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserViews0]].
     *
     * @return \yii\db\ActiveQuery|UserViewQuery
     */
    public function getUserViews0()
    {
        return $this->hasMany(UserView::className(), ['user_came_id' => 'id']);
    }

    /**
     * Gets query for [[UserWorkStories]].
     *
     * @return \yii\db\ActiveQuery|UserWorkStoryQuery
     */
    public function getUserWorkStories()
    {
        return $this->hasMany(UserWorkStory::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
