<?php
	session_start(); 				//start the session
	include 'header.php';			//include header
	$User = $_SESSION['Username'];	//initialized the user to the session
?>
<!DOCTYPE html> <!-- start the HTML Page -->
<html>
<head>
	<title>Library Member Logged in page</title> <!-- Title of the loggedin Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Member logged in WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<nav> <!-- Navigation bar with with the links to all the pages Page -->
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="member.php" >Personal Details</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="search_book.php" >Search Book</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="reserved_book.php" >Reserved Books</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="logout.php" >Log Out</a>
</nav>

<div id = "logged_in"><br><br><br>
	<?php
		if( session_id() ){
			echo "Welcome to Dublin Library<br><br>"; // prompt the user that they have logged in
			echo "Your now logged in as ";
			echo $_SESSION["Username"]."<br><br>"; 	  //echo their username that they have loggedin as.
			echo "Please use the function available to you<br><br>";
		}else{
			header("Location:login.php"); //link them back to the login page they don't belong to the right session
		}
	?>
</div>

<?php
	include 'footer.php'; //include footer
?>

</body>
</html>