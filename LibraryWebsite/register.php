<?php
	include 'myconnection.php'; //include database connection
	include 'header.php';		//include header
	$errors=[];					//array to catch errors 

	if(!empty($_POST)){
	    $UserName = $_POST['username'] ; //initialized the post username 
		$sql=mysql_query("select Username from user where Username='$UserName'"); //query the username
		if(mysql_num_rows($sql) >= 1){ //check if the username already exists, if it is then
			$errors["username"] = "* Username already exist"; //prompt them for an error
		}
		if(empty($_POST["username"])){ //if the post username is empty
			$errors["username"] = "* Enter Username"; //prompt them to enter username
		}
		if(empty($_POST["password"])){ //if the post password is empty
			$errors["password"] = "* Enter Password"; //prompt them to enter password
		}
		else if(strlen($_POST["password"]) !==6){ //if the password length is 6 not character
			$errors["password"] = "* Must be 6 characters long"; //prompt them for an error	
		}
		if($_POST['password'] != $_POST['confirm_password']){ //if the password and confirm password does not match
			$errors["password"] = "* Password does not match."; //prompt them for an error
		}
		if(empty($_POST["confirm_password"])){ //if the post confirm password is empty
			$errors["confirm_password"] = "* Confirm Password"; //prompt them to confirm password
		}
		if(empty($_POST["firstname"])){ //if the post firstname is empty
			$errors["firstname"] = "* Enter FirstName"; //prompt them to enter firstname
		}
		else if(is_numeric($_POST["firstname"])){ //if the post firstname is numeric
			$errors["firstname"] = "* Must be letters only"; //prompt them to enter letters
		}
		if(empty($_POST["surname"])){ //if the post surname is empty
			$errors["surname"] = "* Enter Surname"; //prompt them to enter surname
		}
		else if(is_numeric($_POST["surname"])){ //if the post surname is numeric
			$errors["surname"] = "* Must be letters only"; //prompt them to enter letters
		}
		if(empty($_POST["address1"])){ //if the post address1 is empty
			$errors["address1"] = "* Enter Address Line 1"; //prompt them to enter address1
		}
		if(empty($_POST["address2"])){ //if the post address2 is empty
			$errors["address2"] = "* Enter Address Line 2"; //prompt them to enter address2
		}
		if(empty($_POST["city"])){ //if the post city is empty
			$errors["city"] = "* Enter City"; //prompt them to enter city
		}
		if(empty($_POST["telephone"])){ //if the post telephone is empty
			$errors["telephone"] = "* Enter Telephone No"; //prompt them to telephone no
		}
		else if(strlen($_POST["telephone"]) !==10){ //if the telephone no is not 10 digits in length
			$errors["telephone"] = "* Must be 10 digits"; //prompt them for an error
		}
		else if(!is_numeric($_POST["telephone"])){ //if the telephone no is not numeric
			$errors["telephone"] = "* Must be numeric"; //prompt them for an error
		}
		if(empty($_POST["mobile"])){ //if the post mobile is empty
			$errors["mobile"] = "* Enter Mobile No"; //prompt them to mobile no
		}
		else if(strlen($_POST["mobile"]) !==10){ //if the mobile no is not 10 digits in length
			$errors["mobile"] = "* Must be 10 digits"; //prompt them for an error
		}
		else if(!is_numeric($_POST["mobile"])){ //if the mobile no is not numeric
			$errors["mobile"] = "* Must be numeric"; //prompt them for an error
		}
		
		if(empty($errors)){ //check if all the fields are entered correctly, if it is then
			unset($_POST['register']);
			register($_POST); //go to a register function.
			header('Location: registered.php'); //when everything is correct link to registered.php
		}
		
	}
	
	function register($post_data){
	
		$UserName = $_POST['username'] ; 				//initialized username 
		$Password = $_POST['password'];					//initialized password 
		$Confirm_Password = $_POST['confirm_password']; //initialized confirm password 
		$FirstName = $_POST['firstname'];				//initialized firstname 
		$SurName = $_POST['surname'];					//initialized surname
		$Address1 = $_POST['address1'];					//initialized addresss1
		$Address2 = $_POST['address2'];					//initialized addresss2
		$City = $_POST['city'];							//initialized city
		$Telephone = $_POST['telephone'];				//initialized telephone
		$Mobile = $_POST['mobile'];						//initialized mobile
		
		//insert the data into the correct fields in user table
		$query =  "INSERT INTO user (Username,Password,FirstName,Surname,AddressLine1,AddressLine2,City,Telephone,Mobile)
		VALUES ('$UserName','$Password','$FirstName','$SurName','$Address1','$Address2','$City','$Telephone','$Mobile')";
		$data = mysql_query($query)or die (mysql_error()); 
	}
?>

<!DOCTYPE html> <!-- start the HTML Page -->
<html>
<head>
<title>Dublin Library Registration page</title> <!-- Title of the registration Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Registration WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<div id = "registration">
	<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration </h2>
</div>

<div id = "registration_details">
	<form class = "form" method="POST" action = "register.php"><br> <!-- form to take in the relevant details  -->
		<p class = "username">
			<label for = "username">Username:</label> <!-- label for username -->
			<input  type= "text" name= "username" id = "username" placeholder = "Enter UserName"/> <!-- textbox for username -->
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
						echo $errors ["password"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "confirm_password">
			<label for = "confirm_password">Confirm Password:</label> <!-- label for confirm password -->
			<input  type= "password" name= "confirm_password" id = "confirm_password" placeholder = "Confirm Password"/> <!-- textbox for confirm password -->
			<p class = "error">
				<?php
					if(array_key_exists('confirm_password',$errors)){ //if the confirm password textbox is empty
						echo $errors ["confirm_password"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "firstname">
			<label for = "firstname">FirstName:</label> <!-- label for firstname -->
			<input  type= "text" name= "firstname" id = "firstname" placeholder = "Enter FirstName"/> <!-- textbox for firstname -->
			<p class = "error">
				<?php
					if(array_key_exists("firstname",$errors)){ //if the firstname textbox is empty
						echo $errors ["firstname"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "surname">
			<label for = "surname">Surname:</label> <!-- label for surname -->
			<input  type= "text" name= "surname" id = "surname" placeholder = "Enter Surname"/> <!-- textbox for surname -->
			<p class = "error">
				<?php
					if(array_key_exists('surname',$errors)){ //if the surname textbox is empty
						echo $errors ["surname"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "address1">
			<label for = "address1">Address Line 1:</label> <!-- label for address1 -->
			<input  type= "text" name= "address1" id = "address1" placeholder = "Enter Address Line 1"/> <!-- textbox for address1 -->
			<p class = "error">
				<?php
					if(array_key_exists('address1',$errors)){ //if the address1 textbox is empty
						echo $errors ["address1"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "address2">
			<label for = "address1">Address Line 2:</label> <!-- label for address2 -->
			<input type= "text" name= "address2" id = "address2" placeholder = "Enter Address Line 2"/> <!-- textbox for address2 -->
			<p class = "error">
				<?php
					if(array_key_exists('address2',$errors)){ //if the address2 textbox is empty
						echo $errors ["address2"];	//echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "city">
			<label for = "city">City:</label> <!-- label for city -->
			<input type= "text" name= "city" id = "city" placeholder = "Enter City"/> <!-- textbox for city -->
			<p class = "error">
				<?php
					if(array_key_exists('city',$errors)){ //if the city textbox is empty
						echo $errors ["city"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "telephone"> <!-- label for telephone -->
			<label for = "telephone">Telephone:</label>
			<input type= "text" name= "telephone" id = "telephone" placeholder = "Enter Telephone No"/> <!-- textbox for telephone -->
			<p class = "error">
				<?php
					if(array_key_exists('telephone',$errors)){ //if the city telephone is empty
						echo $errors ["telephone"]; //echo the error message from array
					}
				?>
			</p>
		</p>

		<p class = "mobile">
			<label for = "mobile">Mobile:</label> <!-- label for mobile -->
			<input type= "text" name= "mobile" id = "mobile" placeholder = "Enter Mobile No"/> <!-- textbox for mobile -->
			<p class = "error">
				<?php
					if(array_key_exists('mobile',$errors)){ //if the city mobile is empty
						echo $errors ["mobile"]; //echo the error message from array
					}
				?>
			</p>
		</p><br>

		<p class = "register">
			<input type="submit" name="register" value="Register"/> <!-- button to register -->
		</p>

		<p class = "cancel"> <!-- button to cancel and link them back to login.php page -->
			<input type="reset" name="cancel" value="Cancel" onclick= "window.location.href ='http://localhost/WebD/C12450132Web_Assign/login.php'"/>
		</p>

	</form>
</div>

<?php
	include 'footer.php'; //include footer
?>

</body>
</html>