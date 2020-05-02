<?php


    namespace frontend\controllers;


    use frontend\models\Task;
    use yii\web\Controller;

    class TasksController extends Controller
    {

        public function getTasks()
        {
            return Task::find()
                ->where(['status' => 'new'])
                ->joinWith(['category', 'city'])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        }

        public function actionIndex()
        {
            $tasks = $this->getTasks();
            return $this->render('index', compact("tasks"));
        }

    }
