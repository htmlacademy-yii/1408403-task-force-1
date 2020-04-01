<?php

    namespace htmlacademy;

    use htmlacademy\action\ActionCancel;
    use htmlacademy\action\ActionFinish;
    use htmlacademy\action\ActionReject;
    use htmlacademy\action\ActionStart;

    /**
     * Class Task
     *
     * @package htmlacademy\src\task
     */
    class Task
    {
        /**
         * Statuses
         */
        const STATUS_NEW = 'new';
        const STATUS_CANCELED = 'canceled';
        const STATUS_STARTED = 'started';
        const STATUS_FINISH = 'done';
        const STATUS_FAILED = 'failed';

        /**
         * Actions
         */
        private $cancelTask;
        private $startTask;
        private $finishTask;
        private $rejectTask;

        /**
         * Stored data
         */
        public $currentStatus;
        private $employerID;
        private $employeeID;

        public function __construct ()
        {
            #$this->$employerID = $this->getUser()->id; currently switched off due to lack of the proper object
            $this->employeeID = '';
            $this->currentStatus = self::STATUS_NEW;

            $this->cancelTask = new ActionCancel();
            $this->startTask = new ActionStart();
            $this->finishTask = new ActionFinish();
            $this->rejectTask = new ActionReject();
        }

        /**
         * Generates map for tasks states
         *
         * @return array
         */
        public static function getStatusMap () : array
        {
            return [
                self::STATUS_NEW      => 'Новое',
                self::STATUS_CANCELED => 'Отменено',
                self::STATUS_STARTED  => 'В работе',
                self::STATUS_FINISH   => 'Выполнено',
                self::STATUS_FAILED   => 'Провалено',
            ];
        }

        /**
         * Generates map for actions
         *
         * @return array
         */
        public static function getActionMap () : array
        {
            //Todo: implement later
            return [
//                self::cancelTask() => self::cancelTask->getPublicName(),
//                self::START_TASK  => 'Откликнуться',
//                self::FINISH_TASK => 'Выполнено',
//                self::REJECT_TASK => 'Отказаться'
            ];
        }

        /**
         * Return actions for certain status
         *
         * @param string $status
         * @param string $role
         *
         * @return \htmlacademy\action\ActionCancel|\htmlacademy\action\ActionFinish|\htmlacademy\action\ActionReject|\htmlacademy\action\ActionStart|string
         */
        public function getAvailableActions (string $status, string $role)
        {
            $actions = '';

            //   There are - 'employer' || 'employee'  roles only
            switch ($status) {
                case self::STATUS_NEW:
                    $actions = ($role === 'employer') ? $this->cancelTask : $this->startTask;
                    break;
                case self::STATUS_STARTED:
                    $actions = ($role === 'employer') ? $this->finishTask : $this->rejectTask;
                    break;
            }

            return $actions;

        }

        /**
         * Return the current status of a task
         *
         * @return string translated name for status
         */
        public function getCurrentStatusName () : string
        {
            $statuses = self::getStatusMap();
            return $statuses[$this->currentStatus] ?? '';
        }

        /*TODO: implement later*/
//        /**
//         * Change task status if something happened
//         *
//         * @param string $action
//         *
//         * @return string current action
//         */
//        public function changeStatus (string $action) : string
//        {
//            switch ($action) {
//                case self::CANCEL_TASK:
//                    $this->currentStatus = self::STATUS_CANCELED;
//                    break;
//                case self::START_TASK:
//                    $this->currentStatus = self::STATUS_STARTED;
//                    break;
//                case self::FINISH_TASK:
//                    $this->currentStatus = self::STATUS_FINISH;
//                    break;
//                case self::REJECT_TASK:
//                    $this->currentStatus = self::STATUS_FAILED;
//                    break;
//            }
//            return $this->currentStatus;
//        }


//        /**
//         * Assign worker to task
//         *
//         * @return string
//         */
//        public function assignWorker () : string
//        {
//            $user = $this->getUser();
//            $this->employeeID = $user->id;
//            return $this->changeStatus(self::STATUS_STARTED);
//        }

//        /**
//         *Get client object from DB
//         *
//         * @return object | null
//         */
//        private function getUser ()
//        {
//            /*Importing a client from DB using User class, User will also have role property*/
//            $user = new User();
//            return $user ?? null;
//        }

    }
