<?php


    namespace frontend\controllers;


    use frontend\models\User;
    use yii\web\Controller;

    class UsersController extends Controller
    {

        private function getEmployee()
        {
            return User::find()->joinWith(
                [
                    'userProfile'    => function ($q) {
                        $q->select(['user_id', 'bio']);
                    },
                    'userCategories' => function ($q) {
                        $q->select(['user_id', 'category_id'])->joinWith('category');
                    },
                    'userStatistics'
                ]
            )->where(['role' => 'employee'])->all();
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
