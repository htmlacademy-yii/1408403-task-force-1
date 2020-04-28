<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $city_id
 * @property string|null $birthday
 * @property string|null $bio
 * @property string|null $tel
 * @property string|null $skype
 * @property string|null $telegram
 * @property string|null $avatar
 * @property int|null $is_employer field is described as role
 *
 * @property User $user
 * @property City $city
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'city_id', 'is_employer'], 'integer'],
            [['birthday'], 'safe'],
            [['bio'], 'string'],
            [['tel', 'skype', 'telegram', 'avatar'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
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
            'city_id' => 'City ID',
            'birthday' => 'Birthday',
            'bio' => 'Bio',
            'tel' => 'Tel',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'avatar' => 'Avatar',
            'is_employer' => 'Is Employer',
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
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
    }
}
