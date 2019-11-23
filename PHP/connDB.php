<?php

   function db_connect_ro ()
   {
     $dbh = new PDO("mysql:host=127.0.0.1;dbname=db_group1_f19", 
    	"db_group1_f19_ro", "db_group1_f19_!&");
		 $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
     return ($dbh);
   }
	 
	 function db_connect_w ()
   {
     $dbh = new PDO("mysql:host=127.0.0.1;dbname=db_group1_f19", 
    	"db_group1_f19_w", "db_group1_f19_&!");
		 $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
     return ($dbh);
   }
	 
	 function db_close (&$dbh)
	 {
	 	$dbh = NULL;
	 }
	 
?>