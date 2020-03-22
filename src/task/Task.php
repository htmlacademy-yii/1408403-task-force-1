<?php

    namespace htmlacademy\src\task;

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
        const STATUS_DONE = 'done';
        const STATUS_FAILED = 'failed';

        /**
         * Actions
         */
        const CANCEL_TASK = 'cancel';
        const START_TASK = 'start';
        const FINISH_TASK = 'finish';
        const REJECT_TASK = 'reject';

        /**
         * Stored data
         */
        public $currentStatus;
        private $clientID;
        private $workerID;

        public function __construct ()
        {
            $this->clientID = $this->getUser()->id;
            $this->workerID = '';
            $this->currentStatus = self::STATUS_NEW;
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
                self::STATUS_DONE     => 'Выполнено',
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
            return [
                self::CANCEL_TASK => 'Отменить',
                self::START_TASK  => 'Откликнуться',
                self::FINISH_TASK => 'Выполнено',
                self::REJECT_TASK => 'Отказаться'
            ];
        }

        /**
         * Return actions for certain status
         *
         * @param string $status
         * @param string $role
         *
         * @return array
         */
        public function getAvailableActions (string $status, string $role) : array
        {
            $actions = [];

            //   There are - 'client' || 'worker'  roles only
            switch ($status) {
                case self::STATUS_NEW:
                    $actions = ($role === 'client') ? [self::CANCEL_TASK] : [self::START_TASK];
                    break;
                case self::STATUS_STARTED:
                    $actions = ($role === 'client') ? [self::REJECT_TASK] : [self::START_TASK];
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

        /**
         * Change task status if something happened
         *
         * @param string $action
         *
         * @return string current action
         */
        public function changeStatus (string $action) : string
        {
            switch ($action) {
                case self::CANCEL_TASK:
                    $this->currentStatus = self::STATUS_CANCELED;
                    break;
                case self::START_TASK:
                    $this->currentStatus = self::STATUS_STARTED;
                    break;
                case self::FINISH_TASK:
                    $this->currentStatus = self::STATUS_DONE;
                    break;
                case self::REJECT_TASK:
                    $this->currentStatus = self::STATUS_FAILED;
                    break;
            }
            return $this->currentStatus;
        }


        /**
         * Assign worker to task
         *
         * @return string
         */
        public function assignWorker () : string
        {
            $user = $this->getUser();
            $this->workerID = $user->id;
            return $this->changeStatus(self::STATUS_STARTED);
        }

        /**
         *Get client object from DB
         *
         * @return object | null
         */
        private function getUser ()
        {
            /*Importing a client from DB using User class, User will also have role property*/
            $user = new User();
            return $user ?? null;
        }
    }
