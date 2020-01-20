<?php
    require_once __DIR__ . "/viewInterface.php";
    require_once __DIR__ . "/../Models/userStatusModel.php";

    class FavoritesView implements ViewInterface {
        private $favoritesModel;
        private $userModel;

        public function __construct($model) {
            $this->favoritesModel = $model;
            $this->userModel = new UserStatusModel ();
        }

        public function output () {
            $pokemonArray = $this->favoritesModel->pokemonArray;
            $spritesArray = $this->favoritesModel->spritesArray;
            $isLoggedIn = $this->userModel->isLoggedIn;
            $isAdmin = $this->userModel->isAdmin;
            require_once __DIR__ . "/Templates/favoritesTemplate.php";
        }
    }