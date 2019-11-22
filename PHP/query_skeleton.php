<?php
	// Author: 			Chadd Williams
  // File: 				skeleton.php
  // Date:				March 18, 2013
  // Class:				CS 445	
  // Project: 		In Class PDO Examples
  // Description: skeleton file for PHP/HTML mix
	
	function getEmpAndManager($dbh)
	{
  	$rows = array();

  	$sth = $dbh->prepare(
			"SELECT Employees.FName, Employees.LName, Managers.FName as Manager_FName, Managers.LName as Manager_LName
			FROM Employees
			JOIN WorksOn ON WorksOn.EmpID=Employees.EmpID
			JOIN Software ON WorksOn.SWID=Software.SWID
			JOIN Employees as Managers ON Managers.EmpID=Software.Manager
			ORDER BY Employees.LName, Employees.FName");

		// run the query	
  	$sth->execute();
	
  	while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}
		return $rows;
	}
  
  
?>