<?php

   function db_connect ()
   {
       //needs to be change to the real db
     $dbh = new PDO("mysql:host=127.0.0.1;dbname=sind8948_BigProject", 
    	"sind8948", "cs445_!^%#");
		 $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
     return ($dbh);
   }
	 
	 function db_close (&$dbh)
	 {
	 	$dbh = NULL;
	 }
	 
?>