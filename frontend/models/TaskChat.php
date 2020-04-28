<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task_chat".
 *
 * @property int $id
 * @property int|null $task_id
 * @property string|null $created_at
 * @property int|null $employer_id
 * @property int|null $employee_id
 * @property string|null $message
 * @property int|null $is_new
 *
 * @property Task $task
 * @property User $employer
 * @property User $employee
 */
class TaskChat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'employer_id', 'employee_id', 'is_new'], 'integer'],
            [['created_at'], 'safe'],
            [['message'], 'string'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'created_at' => 'Created At',
            'employer_id' => 'Employer ID',
            'employee_id' => 'Employee ID',
            'message' => 'Message',
            'is_new' => 'Is New',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(User::className(), ['id' => 'employer_id']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(User::className(), ['id' => 'employee_id']);
    }
}
