<?php
    require_once __DIR__ . "/viewInterface.php";

    class UsercreationView implements ViewInterface {
        private $userTakenFlag = false;

        public function __construct ($flag) {
            if (1 == $flag) {
                $this->userTakenFlag = true;
            }
            print "test";
        }

        public function output () {
            $userTakenFlag = $this->userTakenFlag;
            require_once __DIR__ . "/Templates/usercreationTemplate.php";
        }
    }
?>