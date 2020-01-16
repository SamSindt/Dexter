<?php
    require_once __DIR__ . "/../Controllers/loginController.php";

    class LoginView implements ViewInterface {

        public function output () {
            require_once __DIR__ . "/Templates/loginTemplate.php";
        }
    }
?>