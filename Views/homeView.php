<?php
    require_once __DIR__ . "/viewInterface.php";

    class HomeView implements ViewInterface {
        private $model;
        private $controller;

        public function __construct($model, $controller) {
            $this->model = $model;
            $this->controller = $controller;
        }

        public function output() {

            $lowestPKID = $this->model->lowestPKID;
            $highestPKID = $this->model->highestPKID;
            $types = $this->model->types;
            $analogs = $this->model->analogs;
            $colors = $this->model->colors;
            $eggGroups = $this->model->eggGroups;
            require_once __DIR__ . "/Templates/homeTemplate.php";

        }
    }