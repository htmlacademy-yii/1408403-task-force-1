<?php


    namespace htmlacademy\action;


    class Actions
    {
        private $actions = [];

        public function __construct()
        {
            $this->actions = [new ActionStart(), new ActionFinish(), new ActionReject(), new ActionCancel()];
        }

        /**
         * Generates map of actions
         *
         * @return array
         */
        public function getActionMap() : array
        {
            $map = [];
            foreach ($this->actions as $action) {
                $map[$action->getInnerName()] = $action->getPublicName();
            }
            return $map;
        }

        public function getActionObjMap()
        {
            $map = [];
            foreach ($this->actions as $action) {
                $map[$action->getInnerName()] = $action;
            }
            return $map;
        }

    }
