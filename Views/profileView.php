<?php
    require_once __DIR__ . "/viewInterface.php";

    class ProfileView implements ViewInterface {
        private $model;
        private $controller;

        public function __construct($model, $controller) {
            $this->model = $model;
            $this->controller = $controller;
        }

        public function output() {

            $pokemonID = $this->model->pokemonID;
            $pokemonName = $this->model->pokemonName;
            $dexNumber = $this->model->dexNumber;
            $evolvesFrom = $this->model->evolvesFrom;
            $evolvesTo = $this->model->evolvesTo;
            $HP = $this->model->HP;
            $attack = $this->model->attack;
            $defense = $this->model->defense;
            $spAttack = $this->model->spAttack;
            $spDefense = $this->model->spDefense;
            $speed = $this->model->speed;
            $eggGroups = $this->model->eggGroups;
            $typeImages = $this->model->typeImages;
            $profileImage = $this->model->profileImage;
            require_once __DIR__ . "/Templates/profileTemplate.php";
        }
    }
?>