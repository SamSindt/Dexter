<?php
    require_once __DIR__ . "/viewInterface.php";
    require_once __DIR__ . "/../Models/userStatusModel.php";

    class SearchView implements ViewInterface {
        private $searchModel;
        private $userModel;

        public function __construct($model, $controller) {
            $this->searchModel = $model;
            $this->userModel = new UserStatusModel ();
        }

        public function output() {

            $pokemonArray = $this->searchModel->pokemonArray;
            $spritesArray = $this->searchModel->spritesArray;
            $isLoggedIn = $this->userModel->isLoggedIn;
            $isAdmin = $this->userModel->isAdmin;
            require_once __DIR__ . "/Templates/searchTemplate.php";
        }
    }
?>