<?php
    require_once __DIR__ . "/../Models/homeModel.php";
    require_once __DIR__ . "/../Views/homeView.php";

    class HomeController {
        const EMPTY = "NA/";//should be static

        public function home () {//add is logged in
            $model = new HomeModel;
            $view = new HomeView($model, $this);
            $view->output();
        }

        public function redirect () {
            $uri = "/Dexter/Search/Results/";

            //PKID 
            if(isset($_POST["PKID"]) && 0 != $_POST["PKID"]) {
                $uri .= strval($_POST["PKID"]) . "/";
            }
            else {
                $uri .= $this::EMPTY;
            }

            //AnalogID
            if(isset($_POST["AnalogID"]) && 0 != $_POST["AnalogID"]) {
                $uri .= strval($_POST["AnalogID"]) . "/";
            }
            else {
                $uri .= $this::EMPTY;
            }

            //NameLike
            if(isset($_POST["NameLike"]) && !empty($_POST["NameLike"])) {
                $uri .= $_POST["NameLike"] . "/";
            }
            else {
                $uri .= $this::EMPTY;
            }

            //ColorID
            if(isset($_POST["ColorID"]) && 0 != $_POST["ColorID"]) {
                $uri .= strval($_POST["ColorID"]) . "/";
            }
            else {
                $uri .= $this::EMPTY;
            }

            //TypeID
            if(isset($_POST["TypeID"]) && 0 != $_POST["TypeID"]) {
                $uri .= strval($_POST["TypeID"]) . "/";
            }
            else {
                $uri .= $this::EMPTY;
            }

            //EggGroupID
            if(isset($_POST["EggGroupID"]) && 0 != $_POST["EggGroupID"]) {
                $uri .= strval($_POST["EggGroupID"]) . "/";
            }
            else {
                $uri .= $this::EMPTY;
            }

            header("Location: " . $uri);
        }
    }
?>