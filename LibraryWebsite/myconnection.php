<?php 
	define ('DB_HOST','localhost'); //initialized the local host
	define('DB_NAME', 'Library');	//initialized the database
	define('DB_USER', 'root');		//initialized the user
	define('DB_PASSWORD', '');		//initialized the password
	
	$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: ".mysql_error()); //check the connection
	$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: ".mysql_error());					//check the connection
	//$con = mysql_connect('localhost', 'root', '') or die("Failed to connect to MySQL: ".mysql_error());
	//$db=mysql_select_db("Library",$con) or die("Failed to connect to MySQL: ".mysql_error());

	/*
	if (mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL: ". mysqli_connect_errno();
	}
	else{
		echo "Successfully connected to your database";
	}
	*/
?>