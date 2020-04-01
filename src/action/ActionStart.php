<?php


    namespace htmlacademy\action;


    class ActionStart extends Action
    {

        public function __construct ()
        {
            $this->actionName = 'Откликнуться';
            $this->innerName = 'start_action';
        }

        public function getPublicName () : string
        {
            return $this->actionName;
        }

        public function getInnerName () : string
        {
            return $this->innerName;
        }

        public function checkAccess ($employerId, $employeeId, $userId) : bool
        {
            return $employeeId === $userId and $employerId !== $userId;
        }
    }
