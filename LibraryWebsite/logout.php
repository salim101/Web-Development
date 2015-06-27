<?php
session_destroy(); //destroy the session 
//if (session_destroy()){
	header("Location:login.php"); //log the user out and direct them to a login page
//};
?>