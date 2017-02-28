<?php
	//Connecting to database
	$server = '192.168.56.2';
	$schema = 'Woodlands_database';
	$username = "student";
	$password = "student";
	$connectSql = new PDO("mysql:dbname=".$schema."; host=".$server,$username,$password);
?>
