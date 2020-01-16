<?php 
    require_once __DIR__ . "/../Views/loginView.php";

    class LoginController {

        public function show () {
            $view = new LoginView ();
            $view->output();
        }
    }
?>    