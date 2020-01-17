<?php 
    require_once __DIR__ . "/../Views/loginView.php";
    require_once __DIR__ . "/../Helpers/connDB.php";

    class LoginController {

        public function show () {
            $view = new LoginView ();
            $view->output();
        }

        public function submit () {
            session_start();

	        $_SESSION['VALID'] = 0;

            if (isset($_POST['txtUser']) && isset($_POST['txtPassword'])) {
                $userName = $_POST['txtUser'];
                $password = $_POST['txtPassword'];
                
                $dbh = db_connect_ro();
                        
                $result = $this->validateUser($dbh, $userName, $password);
                        
                if ($result) {
                    $_SESSION['VALID'] = 1;
                    $_SESSION['userID'] = (int) $this->getUserID($dbh, $userName);
                    $_SESSION['isAdmin'] = $this->getAdminStatus($dbh, $userName);
                    
                    header('Location: /Pokedex/home');
                }
                else {
                    $this->show ();
                }
            }
        }

        private function validateUser ($dbh, $userName, $password) {
            $retVal = FALSE;
            $salt = $this->getSalt($dbh, $userName);
            
            $hashedPW = crypt($password . $salt,  '$2y$07$8d88bb4a9916b302c1c68c$');
                
            $sth = $dbh->prepare("SELECT * FROM Users WHERE
                        UserName = :userName and Password = :pass");
            $sth->bindValue(":userName", $userName);
            $sth->bindValue(":pass", $hashedPW);
            $sth->execute();

            if (1 == $sth -> rowCount()) {
                $retVal = TRUE;
            }

            return $retVal;
        }

        private function getUserID($dbh, $userName) {
            $userIDNum = -1;
    
            $sth = $dbh->prepare("SELECT * from Users 
                                  WHERE UserName = :userName");
                            
            $sth->bindValue(":userName", $userName);
            
            $sth->execute();
            
            $userData = $sth -> fetch();
            
            $userIDNum = $userData['UID'];
            
            return $userIDNum;
        }

        private function getAdminStatus($dbh, $userName) {
            $isAdmin = FALSE;
    
            $sth = $dbh->prepare("SELECT Admin FROM Users 
                            WHERE UserName = :userName");
                            
            $sth->bindValue(":userName", $userName);
                
            $sth->execute();
            
            $adminData = $sth -> fetch();
            
            if (1 == $adminData['Admin']) {
                    $isAdmin = TRUE;
            }
            return $isAdmin;
        }

        private function getSalt ($dbh, $user) {
            $retVal = "NONE";
            
            $sth = $dbh -> prepare("SELECT Salt FROM Users WHERE
                         UserName = :user");
            $sth -> bindValue(":user", $user);
            $sth -> execute();
            
            if (1 == $sth -> rowCount()) {
                $row = ($sth->fetch());
                $retVal = $row[0];
            }
            return $retVal;
        }
    }
?>    