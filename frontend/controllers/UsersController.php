<?php


    namespace frontend\controllers;


    use frontend\models\User;
    use frontend\models\UserProfile;
    use frontend\models\UserStatistics;
    use yii\web\Controller;

    class UsersController extends Controller
    {

        public function getEmployee()
        {
            return User::find()->joinWith(
                [
                    'userStatistics' => function ($q) {
                        $q->select(['user_id', '(tasks_done + tasks_failed) AS tasks', 'reviews_received', 'rating']);
                    },
                    'userProfile'    => function ($q) {
                        $q->select(['user_id', 'bio']);
                    },
                    'userCategories'=> function ($q) {
                        $q->select(['user_id','category_id'])->joinWith('category');
                    },
                ]
            )->where(['is_employer' => '0'])->asArray()->all();
        }

        public function actionIndex()
        {
            return $this->render(
                'index',
                [
                    'employees' => $this->getEmployee()
                ]
            );
        }

    }
