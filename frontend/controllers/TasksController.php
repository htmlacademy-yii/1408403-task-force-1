<?php


    namespace frontend\controllers;


    use frontend\models\Task;
    use yii\web\Controller;

    class TasksController extends Controller
    {

        public function getTasks()
        {
            $model = new Task();
            return $model::find()
                ->where(['status' => 'new'])
                ->joinWith('category')
                ->joinWith('city')
                ->orderBy(['created_at' => SORT_DESC])
                ->asArray()->all();
        }

        public function actionIndex()
        {
            $tasks = $this->getTasks();
            return $this->render('index', ['tasks' => $tasks]);
        }

    }
