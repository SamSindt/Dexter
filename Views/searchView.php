<?php
    require_once __DIR__ . "/viewInterface.php";

    class SearchView implements ViewInterface {
        private $model;
        private $controller;

        public function __construct($model, $controller) {
            $this->model = $model;
            $this->controller = $controller;
        }

        public function output() {

            $pokemonArray = $this->model->pokemonArray;
            $spritesArray = $this->model->spritesArray;
            require_once __DIR__ . "/Templates/searchTemplate.php";
        }
    }
?>