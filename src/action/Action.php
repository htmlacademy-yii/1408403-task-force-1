<?php


    namespace htmlacademy\action;


    abstract class Action
    {
        protected $actionName;
        protected $innerName;

        /**
         * Return public status name
         */
        abstract public function getPublicName ();

        /**
         * Return inner status name
         */
        abstract public function getInnerName ();

        /**
         * Return whether action is available or not
         *
         * @param string $employerId - id of employer
         * @param string $employeeID - id of the employee
         * @param string $userId     - current user id
         */
        abstract public function checkAccess(int $employerId, int $employeeID, int $userId);
    }
