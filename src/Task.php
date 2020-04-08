<?php

    declare(strict_types = 1);

    namespace htmlacademy;

    use htmlacademy\action\Actions;
    use htmlacademy\ex\TaskStatusException;
    use htmlacademy\ex\UserRoleException;

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
        private $actions;

        /**
         * Stored data
         */
        public $currentStatus;
        private $employerID;
        private $employeeID;

        public function __construct()
        {
            #$this->$employerID = $this->getUser()->id; currently switched off due to lack of the proper object
            $this->employeeID = '';
            $this->currentStatus = self::STATUS_NEW;

            $this->actions = new Actions();
        }

        /**
         * Generates map for tasks states
         *
         * @return array
         */
        public static function getStatusMap() : array
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
         * @param string $status
         * @param string $role
         *
         * @return \htmlacademy\action\Action
         * @throws \htmlacademy\ex\TaskStatusException
         * @throws \htmlacademy\ex\UserRoleException
         *
         */
        public function getAvailableActions(string $status, string $role) /*: Action*/
        {
            $statusMap = $this->getStatusMap();

            if (!isset($statusMap[$status])) {
                throw new TaskStatusException('Wrong task status');
            }

            if ($role === 'employer' xor $role !== 'employee') {
                throw new UserRoleException();
            }

            $actions = $this->actions->getActionObjMap();
            $action = null;

            //   There are - 'employer' || 'employee'  roles only
            switch ($status) {
                case self::STATUS_NEW:
                    $action = ($role === 'employer') ? $actions['cancel_action'] : $actions['start_action'];
                    break;
                case self::STATUS_STARTED:
                    $action = ($role === 'employer') ? $actions['finish_action'] : $actions['reject_action'];
                    break;
                default:
                    throw new TaskStatusException('Wrong task status');
            }

            return $action;
        }

        /**
         * Return the current status of a task
         *
         * @return string translated name for status
         */
        public function getCurrentStatusName() : ?string
        {
            $statuses = self::getStatusMap();
            return $statuses[$this->currentStatus] ?? null;
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
