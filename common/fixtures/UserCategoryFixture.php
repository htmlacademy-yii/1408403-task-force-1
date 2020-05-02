<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class UserCategoryFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\UserCategory';
    public $dataFile = '@common/fixtures/data/userCategory.php';
}
