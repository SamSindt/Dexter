<?php
    require_once __DIR__ . "/viewInterface.php";

    class UsercreationView implements ViewInterface {
        public function output () {
            require_once __DIR__ . "/Templates/usercreationTemplate.php";
        }
    }
?>