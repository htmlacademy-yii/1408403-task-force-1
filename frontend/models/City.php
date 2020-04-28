<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $city_id
 * @property string|null $name
 * @property string|null $lat
 * @property string|null $long
 *
 * @property Task[] $tasks
 * @property UserProfile[] $userProfiles
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lat', 'long'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'name' => 'Name',
            'lat' => 'Lat',
            'long' => 'Long',
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['city_id' => 'city_id']);
    }

    /**
     * Gets query for [[UserProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['city_id' => 'city_id']);
    }
}
