<?php
    require_once __DIR__ . "/viewInterface.php";
    require_once __DIR__ . "/../Models/userStatusModel.php";

    class ProfileView implements ViewInterface {
        private $profileModel;
        private $userModel;

        public function __construct($model, $controller) {
            $this->profileModel = $model;
            $this->userModel = new UserStatusModel ();
        }

        public function output() {

            $pokemonID = $this->profileModel->pokemonID;
            $pokemonName = $this->profileModel->pokemonName;
            $dexNumber = $this->profileModel->dexNumber;
            $evolvesFrom = $this->profileModel->evolvesFrom;
            $evolvesTo = $this->profileModel->evolvesTo;
            $HP = $this->profileModel->HP;
            $attack = $this->profileModel->attack;
            $defense = $this->profileModel->defense;
            $spAttack = $this->profileModel->spAttack;
            $spDefense = $this->profileModel->spDefense;
            $speed = $this->profileModel->speed;
            $eggGroups = $this->profileModel->eggGroups;
            $typeImages = $this->profileModel->typeImages;
            $profileImage = $this->profileModel->profileImage;
            $isLoggedIn = $this->userModel->isLoggedIn;
            $isAdmin = $this->userModel->isAdmin;
            require_once __DIR__ . "/Templates/profileTemplate.php";
        }
    }
?>