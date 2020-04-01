<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    error_reporting(E_ALL);

    use htmlacademy\Task;

    require '../vendor/autoload.php';

    $task = new Task();
    var_dump($task->getAvailableActions(TASK::STATUS_NEW, 'employer'));
    var_dump($task->getAvailableActions(TASK::STATUS_NEW, 'employee'));
    var_dump($task->getAvailableActions(TASK::STATUS_STARTED, 'employer'));
    var_dump($task->getAvailableActions(TASK::STATUS_STARTED, 'employee'));
    var_dump($task->getAvailableActions(TASK::STATUS_NEW, 'employer'));
//    var_dump($task->getActionMap());




//    if ($task->changeStatus('start') !== Task::STATUS_STARTED) {
//    throw new Exception('Something went wrong');
//}










    /**
     * Strange stuff - IT DOES NOT WORK
     */
    #assert($task->changeStatus('start') === Task::STATUS_CANCELED, 'status started');
    #var_dump($task->changeStatus('cancel'), Task::STATUS_STARTED, $task);
    #assert(1 < 2, 'error!'); #– ничего не выводит
    #assert(1 > 2, 'error!'); #– сработает Warning
    #assert($task->changeStatus('start') !== Task::STATUS_STARTED, 'Не получилось начать задание');
    #assert(false, 'error!!!');
