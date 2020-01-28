<?php
    require_once __DIR__ . "/../Views/usercreationView.php";

    class UsercreationController {

        public function show () {
            $view = new UsercreationView ();
            $view->output ();
        }

        public function create () {
            //TODO
        }
    }

?>