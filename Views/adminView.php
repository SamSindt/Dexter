<?php
    require_once __DIR__ . "/viewInterface.php";
    require_once __DIR__ . "/../Models/userStatusModel.php";

    class AdminView implements ViewInterface {
        private $adminModel;
        private $userModel;

        public function __construct ($model) {
            $this->adminModel = $model;
            $this->userModel = new UserStatusModel ();
        }

        public function output () {
            $users = $this->adminModel->users;
            $isLoggedIn = $this->userModel->isLoggedIn;
            $isAdmin = $this->userModel->isAdmin;
            require_once __DIR__ . "/Templates/adminTemplate.php";
        }
    }