<?php
	include 'myconnection.php'; 	//include database connection
	include 'header.php';			//include header
	session_start();				//start the session
	$User = $_SESSION['Username'];	//initialized the user to the session
?>

<!DOCTYPE html> <!-- start the HTML Page -->
<html>
<head>
	<title>Library Member reserved book record page</title> <!-- Title of the reserved Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Reserved Book Record WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<nav> <!-- Navigation bar with with the links to all the pages Page -->
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="member.php" >Personal Details</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="search_book.php" >Search Book</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="reserved_book.php" >Reserved Books</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|  
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="logout.php" >Log Out</a>
</nav>

<div id = "reserved_books">
	<p class = "reserved_result">
		Your Reserved Books
	</p><br>

	<?php
		$date = getdate(); 	//function to get the current date
		$y = $date['year'];	//get the year
		$m = $date['mon'];	//get the month
		$d = $date['mday']; //get the day date

		if(!empty($_POST['reserve'])){ //if the post reserve checkbox is not empty then

			foreach($_POST['reserve'] as $reserve){ //reserve the selected books and insert the information into the database
				$query = "INSERT INTO reservations VALUES ('$reserve','$User','$y-$m-$d')" or die(mysql_error());
				mysql_query($query);//update the book table to mark the book is reserved 
				$query = "UPDATE books SET Reserved= 'Y' WHERE ISBN= '$reserve'"or die(mysql_error());
				mysql_query($query);
			}
			echo "Your Reservation has been successfully completed<br><br>"; //prompt the user that they have reserved successfully
		}
	?>

	<?php
		//query and join the two table to get the reserved book information and display it in a table
		$query= "select b.ISBN,b.BookTitle,b.Author,b.Edition,b.Year,r.ReservedDate FROM books b join reservations r on b.ISBN=r.ISBN WHERE b.ISBN=r.ISBN and r.Username = '$User'" or die(mysql_error());
		echo '<table border="1"  cellpadding = "2" cellspacing = "10">';
		echo "<tr><td>ISBN</td><td>Title</td><td>Author</td><td>Edition</td><td>Year</td><td>Reserved Date</td><td>Return</td></tr>";

		$result = mysql_query($query);
			while($row = mysql_fetch_array($result)){
				echo("<tr><td>");
				echo (htmlentities($row[0]));
				echo("</td><td>");
				echo (htmlentities($row[1]));
				echo("</td><td>");
				echo (htmlentities($row[2]));
				echo("</td><td>");
				echo (htmlentities($row[3]));
				echo("</td><td>");
				echo (htmlentities($row[4]));
				echo("</td><td>");
				echo (htmlentities($row[5]));
				echo("</td><td>");
			
				echo "<form  method= POST>";//check box to return a box 
				echo "<input type = checkbox name = return[] value= ".$row[0]."></input>";
				echo("</td></tr>");
			}
		//var_dump($_POST['return']);
			echo "</table>";
			echo "<br><br>";
		
			if(!empty($_POST['return'])){ //check if the return is not empty 
				foreach($_POST['return'] as $return){ //for loop to remove the reserved book from reservations table
					$query = "DELETE FROM reservations WHERE ISBN= '$return'" or die (mysql_error());
					mysql_query($query); //update the books table to mark the as not reserved 
					$query = "UPDATE books SET Reserved = 'N' WHERE ISBN= '$return'";
					mysql_query($query);
					}
				echo "Your book return has been successfully completed<br>"; //prompt the user they have returned successfully 
				
				header("Location:reserved_book.php"); //re-direct them to the same page to update the records on the web page
				//header("refresh: 1;");
				
			}
				echo"<input type='submit' name='return_book' value='Return selected books'/>"; //button to return selected books
				echo "</form>";
	?>
	</p>
</div>

<?php
	include 'footer.php'; //include footer
?>

</body>
</html>