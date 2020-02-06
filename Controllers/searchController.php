<?php
    require_once __DIR__ . "/../Models/searchModel.php";
    require_once __DIR__ . "/../Views/searchView.php";

    class SearchController {

        public function results ($pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID) {
            $model = new SearchModel($pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID);
            $view = new SearchView($model, $this);
            $view->output();
        }
    }
?>