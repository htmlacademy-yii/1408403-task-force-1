<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string|null $created_at
 * @property int|null $created_by_user_id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $category_id
 * @property int|null $city_id
 * @property int|null $budget
 * @property string|null $expiration
 * @property float|null $lat
 * @property float|null $long
 * @property string|null $status
 * @property int|null $assigned_user_id
 * @property string|null $finished_status status on task finishing
 *
 * @property Attachment[] $attachments
 * @property Notification[] $notifications
 * @property Response[] $responses
 * @property City $city
 * @property Category $category
 * @property User $createdByUser
 * @property User $assignedUser
 * @property TaskChat[] $taskChats
 * @property Testimonial[] $testimonials
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'expiration'], 'safe'],
            [['created_by_user_id', 'category_id', 'city_id', 'budget', 'assigned_user_id'], 'integer'],
            [['title', 'description'], 'string'],
            [['lat', 'long'], 'number'],
            [['status'], 'string', 'max' => 20],
            [['finished_status'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_user_id' => 'id']],
            [['assigned_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['assigned_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'created_by_user_id' => 'Created By User ID',
            'title' => 'Title',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'city_id' => 'City ID',
            'budget' => 'Budget',
            'expiration' => 'Expiration',
            'lat' => 'Lat',
            'long' => 'Long',
            'status' => 'Status',
            'assigned_user_id' => 'Assigned User ID',
            'finished_status' => 'Finished Status',
        ];
    }

    /**
     * Gets query for [[Attachments]].
     *
     * @return \yii\db\ActiveQuery|AttachmentQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery|NotificationQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery|ResponseQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[CreatedByUser]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedByUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by_user_id']);
    }

    /**
     * Gets query for [[AssignedUser]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getAssignedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'assigned_user_id']);
    }

    /**
     * Gets query for [[TaskChats]].
     *
     * @return \yii\db\ActiveQuery|TaskChatQuery
     */
    public function getTaskChats()
    {
        return $this->hasMany(TaskChat::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials]].
     *
     * @return \yii\db\ActiveQuery|TestimonialQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonial::className(), ['task_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}
