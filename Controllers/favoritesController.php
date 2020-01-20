<?php
    require_once __DIR__ . "/../Models/favoritesModel.php";
    require_once __DIR__ . "/../Views/favoritesView.php";

    class FavoritesController {
        private $model;

        public function show () {
            $this->model = new FavoritesModel;
            $view = new FavoritesView ($this->model);
            $view->output ();
        }
    }