<?php
    require_once __DIR__ . "/viewInterface.php";

    class UsercreationView implements ViewInterface {
        private $userTakenFlag = false;
        private $userWSFlag = false;

        public function __construct ($flag) {
            if (1 == $flag) {
                $this->userTakenFlag = true;
            }
            else if (2 == $flag) {
                $this->userWSFlag = true;
            }
        }

        public function output () {
            $userTakenFlag = $this->userTakenFlag;
            $userWSFlag = $this->userWSFlag;
            require_once __DIR__ . "/Templates/usercreationTemplate.php";
        }
    }
?>