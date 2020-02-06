<?php
    require_once __DIR__ . "/../Models/profileModel.php";
    require_once __DIR__ . "/../Views/profileView.php";

    class ProfileController {

        public function show ($pokemonID) {
            $model = new ProfileModel($pokemonID);
            $view = new ProfileView($model, $this);
            $view->output();
        }
    }
?>