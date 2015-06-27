<?php
	include 'myconnection.php'; //include database connection
	include 'header.php'; 		//include header
	session_start();			//start the session
	
	$errors=[];					//array to catch errors 

	if(!empty($_POST)){	
		$UserName=mysql_real_escape_string($_POST['username']); //initialized the username 
		$Password=mysql_real_escape_string($_POST['password']);	//initialized the password 

		$query = "SELECT * FROM user WHERE Username='$UserName' AND Password = '$Password'" or die (mysql_error()); //query the database
		$res = mysql_query($query);	//check usernmame and password match

		$rows = mysql_num_rows($res); //initialized the rows to the the result

		if($rows ==1){	//if the username and password matches
			header('Location: loggedin.php'); //direct them to the 'loggedin.php page'
			
			$_SESSION['Username'] = $_POST['username']; //start the session of the user
		}
		else{ //if the username and password does not matches
			$errors["username"] = "* username and password not found"; 	//prompt them with an error
		}

		if(empty($_POST["username"])){ //if the post username is empty
			$errors["username"] = "* Enter Username"; //prompt them to enter username
		}
		if(empty($_POST["password"])){ //if the post password is empty
			$errors["password"] = "* Enter Password"; //prompt them to enter password
		}
	}//end if !empty post

?>

<!DOCTYPE html> <!-- start the HTML Page -->
<html>
<head>
	<title>Dublin Library Login page</title> <!-- Title of the login Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Login WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<div id = "login">
	<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login</h2>
</div>

<div id = "login_details">
	<form class = "form" method = "POST" action = "login.php"><br> <!-- form to take in the relevant details  -->
		<p class = "username">
			<label for = "username">Username:</label> <!-- label for username -->
			<input type= "text" name= "username" id = "username" placeholder = "Enter UserName"/> <!-- textbox for username -->
			<p class = "error">
				<?php
					if(array_key_exists('username',$errors)){ //if the username textbox is empty 
						echo $errors ["username"]; //echo the error message from array
					}
				?>
			</p>
		</p>
		
		<p class  = "password">
			<label for = "password">Password:</label> <!-- label for password -->
			<input type= "password" name= "password" id = "password" placeholder="Enter Password"/> <!-- textbox for password -->
			<p class = "error">
				<?php
					if(array_key_exists('password',$errors)){ //if the password textbox is empty 
						echo $errors ["password"];	//echo the error message from array
					}
				?>
			</p>
		</p>
		
		<p class = "login">
			<input type="submit" name="login" value="Login"/> <!-- button to login -->
		</p>

		<p class = "cancel">
			<input type="reset" name="cancel" value="Cancel"/> <!-- button to cancel -->
		</p>
	</form><br><br>
	
	<a href= "http://localhost/WebD/C12450132Web_Assign/register.php" style="text-decoration:none"> <!-- link if the user want to register -->
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Become a member now</a>

</div>

<?php
	include 'footer.php'; //include the footer
?>
</body>
</html>