<?php

    namespace htmlacademy\action;


    class ActionCancel extends Action
    {

        public function __construct ()
        {
            $this->actionName = 'Отменить';
            $this->innerName = 'cancel_action';
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
            return $employerId === $userId and $userId !== $employeeId;
        }
    }
