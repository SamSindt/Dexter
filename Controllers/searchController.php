<?php
    require_once __DIR__ . "/../Models/searchModel.php";
    require_once __DIR__ . "/../Views/searchView.php";

    class SearchController {
        private $model;

        public function results ($pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID) {//add is logged in
            $this->model = new SearchModel($pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID);
            $view = new SearchView($this->model, $this);
            $view->output();
        }
    }
?>