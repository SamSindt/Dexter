<?php
    require_once __DIR__ . "/viewInterface.php";
    require_once __DIR__ . "/../Models/userStatusModel.php";
    require_once __DIR__ . "/../Models/adminUpdateProfileModel.php";

    class ProfileView implements ViewInterface {
        private $profileModel;
        private $userModel;
        private $adminUpdateProfileModel;

        public function __construct($model, $controller) {
            $this->profileModel = $model;
            $this->userModel = new UserStatusModel ();
            if ($this->userModel->isAdmin) {
                $this->adminUpdateProfileModel = new AdminUpdateProfileModel($this->profileModel->pokemonID);
            }
            else {
                $this->adminUpdateProfileModel = null;
            }
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
            $isFavorited = $this->profileModel->isFavorited;
            $isLoggedIn = $this->userModel->isLoggedIn;
            $isAdmin = $this->userModel->isAdmin;
            $unusedColors = array();
            $unusedAnalog = array ();

            if (null != $this->adminUpdateProfileModel) {
                $unusedColors = $this->adminUpdateProfileModel->unusedColors;
                $unusedAnalog = $this->adminUpdateProfileModel->unusedAnalogs;
            }

            require_once __DIR__ . "/Templates/profileTemplate.php";
        }
    }
?>