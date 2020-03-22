<?php

    namespace Task;

    class Task
    {
//      states
        private const STATUS_NEW = 'new';
        private const STATUS_CANCELED = 'canceled';
        private const STATUS_STARTED = 'started';
        private const STATUS_DONE = 'done';
        private const STATUS_FAILED = 'failed';


        //actions on new status
        private const CANCEL_TASK = 'cancel';
        private const START_TASK = 'start';
        //actions on started status
        private const FINISH_TASK = 'finish';
        private const REJECT_TASK = 'reject';

        //data saving
        private $clientID = '';
        private $workerID = '';
        public $currentState = '';

        public function __construct ()
        {
            $this->clientID = $this->getClientID();
            $this->currentState = self::STATUS_NEW;
        }

        /**
         * Generates map for tasks states
         *
         */
        public function getStatusMap ()
        {
        }

        /**
         *Get client ID from DB
         */
        private function getClientID () {}

        /**
         * Return actions for certain status
         *
         * @param $status - text status
         */
        public function getAvailableActions ($status)
        {

        }

        /**
         * Return the current status of a task
         */
        public function getCurrentStatus ()
        {

        }

        /**
         * Change task status for next state
         * @param $currentState string
         */
        public function changeStatus ($currentState){}


        /**
         * Assign worker to task
         */
        public function assignWorker() {
//            $this->workerID = ''; //setting the worker ID to
//            $this->changeStatus($this->currentState);
        }
    }
