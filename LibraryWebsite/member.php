<?php
	include  'myconnection.php';	//include database connection
	include 'header.php';			//include header
	session_start(); 				//start the session
	$User = $_SESSION['Username'];	//initialized the user to the session
?>

<!DOCTYPE html>	<!-- start the HTML Page -->
<html>
<head>
	<title>Library Member page</title> <!-- Title of the member details Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Member Personal Details WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<nav> <!-- Navigation bar with with the links to all the pages Page -->
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="member.php" >Personal Details</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="search_book.php" >Search Book</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="reserved_book.php" >Reserved Books</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="logout.php" >Log Out</a>
</nav>

<div id = "account_details"><br>
	Account Details<br>
</div>

<div id = "member_details">
	<p class = "m_details">
		<?php
			//session_start();
			//$User = $_SESSION['Username'];
			//$query = "SELECT * FROM  user WHERE username='$User'" or die (mysql_error());
	
			$result = mysql_query("SELECT *FROM user WHERE Username='$User'"); //query the user that is logged in 
			while ( $row = mysql_fetch_row($result)) {
				echo '<table border="1"  cellpadding = "2" cellspacing = "10">'; //show all of his/her details in a table
				echo "<tr><td>Username<td><td>";
				echo(htmlentities($row[0]));
				echo "</td></tr><tr><td>";
	
				echo "Password<td><td>";
				echo(htmlentities($row[1]));
				echo "</td></tr><tr><td>";
	
				echo "FirstName<td><td>";
				echo(htmlentities($row[2]));
				echo "</td></tr><tr><td>";
	
				echo "LastName<td><td>";
				echo(htmlentities($row[3]));
				echo "</td></tr><tr><td>";
	
				echo "Address Line 1<td><td>";
				echo(htmlentities($row[4]));
				echo "</td></tr><tr><td>";
	
				echo "Address Line 2<td><td>";
				echo(htmlentities($row[5]));
				echo "</td></tr><tr><td>";
	
				echo "City<td><td>";
				echo(htmlentities($row[6]));
				echo "</td></tr><tr><td>";
	
				echo "Telephone<td><td>";
				echo(htmlentities($row[7]));
				echo "</td></tr><tr><td>";
	
				echo "Mobile<td><td>";
				echo(htmlentities($row[8]));
				echo "</td></tr>";
				echo "</table>";
			}
?>
	</p>
</div>

<?php
	include 'footer.php'; //include footer
?>

</body>
</html>