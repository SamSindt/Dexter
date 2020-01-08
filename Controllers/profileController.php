<?php
    require_once __DIR__ . "/../Models/profileModel.php";
    require_once __DIR__ . "/../Views/profileView.php";

    class ProfileController {
        private $model;

        public function show ($pokemonID) {//add is logged in
            $this->model = new ProfileModel($pokemonID);
            $view = new ProfileView($this->model, $this);
            $view->output();
        }

    }
?>