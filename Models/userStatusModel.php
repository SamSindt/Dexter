<?php
    require_once __DIR__ . "/../Helpers/connDB.php";

    class UserStatusModel {
        public $isLoggedIn;
        public $isAdmin;

        public function __construct() {
            session_start();
            $this->isLoggedIn = $this->getLoginStatus ();
            $this->isAdmin = $this->getAdminStatus();
        }

        private function getLoginStatus () {
            
            return (isset($_SESSION['VALID']) && 1 == $_SESSION['VALID']);
        }

        private function getAdminStatus () {
            return (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']);
        }
    }