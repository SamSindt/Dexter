<?php
    require_once __DIR__ . "/../Models/favoritesModel.php";
    require_once __DIR__ . "/../Views/favoritesView.php";
    require_once __DIR__ . "/../Helpers/connDB.php";

    class FavoritesController {

        public function show () {
            $model = new FavoritesModel;
            $view = new FavoritesView ($model);
            $view->output ();
        }

        public function unfavorite ($pokemonID) {
            
            if(!isset($_SESSION)) { 
                session_start(); 
            } 
            
            if(isset($_SESSION['userID'])) {
                
                $dbh = db_connect_w();
                
                $sth = $dbh->prepare("DELETE FROM HasFavorite
                                        WHERE UID = :userID AND PKID = :pokemonID");
                $sth->bindValue(":pokemonID", $pokemonID);
                $sth->bindValue(":userID", $_SESSION['userID']);
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
                                      VALUES (:userID, :pokemonID)");
                $sth->bindValue(":pokemonID", $pokemonID);
                $sth->bindValue(":userID", $_SESSION['userID']);
                $sth->execute();
                db_close($dbh);
            }
        }
    }