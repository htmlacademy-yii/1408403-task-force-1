<?php

    use htmlacademy\Task;

    $loader = require '../vendor/autoload.php';

    $task = new Task();

    var_dump(assert($task->changeStatus('start') === Task::STATUS_STARTED), 'status started');
    var_dump($task->changeStatus('cancel'), Task::STATUS_STARTED, $task);
