<?php
    require_once __DIR__ . "/../Models/adminModel.php";
    require_once __DIR__ . "/../Views/adminView.php";


    class AdminController {
        public function show () {
            $model = new AdminModel;
            $view = new AdminView ($model);
            $view->output();
        }
    }