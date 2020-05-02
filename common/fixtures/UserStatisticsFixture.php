<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class UserStatisticsFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\UserStatistics';
    public $dataFile = '@common/fixtures/data/userStatistics.php';
}
