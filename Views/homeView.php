<?php
    require_once __DIR__ . "/viewInterface.php";
    require_once __DIR__ . "/../Models/userStatusModel.php";

    class HomeView implements ViewInterface {
        private $homeModel;
        private $userModel;

        public function __construct($model, $controller) {
            $this->homeModel = $model;
            $this->userModel = new UserStatusModel ();
        }

        public function output() {

            $lowestPKID = $this->homeModel->lowestPKID;
            $highestPKID = $this->homeModel->highestPKID;
            $types = $this->homeModel->types;
            $analogs = $this->homeModel->analogs;
            $colors = $this->homeModel->colors;
            $eggGroups = $this->homeModel->eggGroups;
            $isLoggedIn = $this->userModel->isLoggedIn;
            $isAdmin = $this->userModel->isAdmin;

            require_once __DIR__ . "/Templates/homeTemplate.php";

        }
    }