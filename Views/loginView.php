<?php
    require_once __DIR__ . "/../Controllers/loginController.php";

    class LoginView implements ViewInterface {
        private $invalidFlag = false;

        public function __construct($flag) {
            if (1 == $flag) {
                $this->invalidFlag = true;
            }
        }

        public function output () {
            $invalidFlag = $this->invalidFlag;
            require_once __DIR__ . "/Templates/loginTemplate.php";
        }
    }
?>