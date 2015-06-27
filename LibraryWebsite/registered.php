<?php
	include 'header.php'; //include header
?>

<!DOCTYPE html> <!-- start the HTML Page -->
<html>
<head>
	<title>Library Member Registered page</title> <!-- Title of the registered Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Member Registered WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<div id = "registered"><br><br><br>
	<?php
		echo "Congratulation<br><br>"; //prompt the user that they have registered 
		echo "you have been successfully registered<br><br>";
	?>
	<a href= "http://localhost/WebD/C12450132Web_Assign/login.php" style="text-decoration:none">
		Please click here to login now</a> <!-- provide them with a link to login Page -->
</div>

<?php
	include 'footer.php'; //include footer
?>

</body>
</html>