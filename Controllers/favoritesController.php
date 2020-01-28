<?php
    require_once __DIR__ . "/../Models/favoritesModel.php";
    require_once __DIR__ . "/../Views/favoritesView.php";
    require_once __DIR__ . "/../Helpers/connDB.php";

    class FavoritesController {
        private $model;

        public function show () {
            $this->model = new FavoritesModel;
            $view = new FavoritesView ($this->model);
            $view->output ();
        }

        public function unfavorite ($pokemonID) {
            
            if(!isset($_SESSION)) { 
                session_start(); 
            } 
            
            if(isset($_SESSION['userID'])) {
                
                $dbh = db_connect_w();
                
                $sth = $dbh->prepare("DELETE FROM HasFavorite
                                        WHERE UID = " . $_SESSION['userID']
                                        . " AND PKID = " . $pokemonID);
                $sth->execute();
                db_close($dbh);
                
	        }
        }

        public function favorite ($pokemonID) {
            
            if(!isset($_SESSION)) { 
                session_start(); 
            } 

            if(isset($_SESSION['userID'])) {
                $dbh = db_connect_w();
                
                $sth = $dbh->prepare("INSERT INTO HasFavorite (UID, PKID)
                                      VALUES (" . $_SESSION['userID'] . ", " . $pokemonID . ")");
                $sth->execute();
                db_close($dbh);
            }
        }
    }