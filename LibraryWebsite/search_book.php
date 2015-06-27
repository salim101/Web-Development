<?php
	include 'myconnection.php'; 	//include database connection
	include 'header.php';			//include header
	session_start();				//start the session
	$User = $_SESSION['Username'];  //initialized the user to the session
?>

<!DOCTYPE html> <!-- start the HTML Page -->
<html>
<head>
	<title>Library Book Search page</title> <!-- Title of the search Page -->
	<meta name = "author" content = "C12450132"/>
	<meta name = "Description" content = "Search Book WebPage"/>
	<link rel = "stylesheet" href = "mystyle.css" type = "text/css"/> <!-- link the page to a style sheet -->
</head>

<body>

<nav> <!-- Navigation bar with with the links to all the pages Page -->
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="member.php" >Personal Details</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="search_book.php" >Search Book</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="reserved_book.php" >Reserved Books</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| 
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href ="logout.php" >Log Out</a>
</nav>

<div id = "search_book"><br><br><br>
	<form method = "POST"> <!-- form to take and post search by category  -->
		&nbsp;&nbsp;<label for = "search_by_category">Search By Category:</label> <!-- label to search by category -->
		<p class = "search">
			<select name="categories">
				<option value="all">All</option>
		</p>

		<?php
			$query = "SELECT * FROM categories"; //query to select everything from categories table 
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result)){ 
				echo "<option value=\"" . $row ['CategoryID']. "\">" . $row['CategoryDescription']. "</option>"; 
			}
		?>
			</select>
		<p class = "search1"> <!-- button to search by category -->
			<input type="submit" name="search1" value="Search"/>
		</p>
	</form>

<!------------------------------------------------------------------------------------------------>

	<form method = "POST"> <!-- form to take and post search by title  -->
		&nbsp;&nbsp;<label for = "search_by_title">Search By Title:</label> <!-- label to search by title -->
		<p class = "search">
			<input type= "text" name= "title" id = "title" placeholder = "Enter title of book"/> <!-- textbox to type title of book -->
		</p>
		<p class = "search2">
			<input type="submit" name="search2" value="Search"/> <!-- button to search by title -->
		</p>
	</form>
		
<!------------------------------------------------------------------------------------------------>

	<form method = "POST"> <!-- form to take and post search by author  -->
		&nbsp;&nbsp;<label for = "search_by_author">Search By Author:</label> <!-- label to search by author -->
		<p class = "search">
			<input type= "text" name= "author" id = "author" placeholder = "Enter author name"/> <!-- textbox to type author of the book -->
		</p>
		<p class = "search3">
			<input type="submit" name="search3" value="Search"/> <!-- button to search by author -->
		</p>
	</form>
	
</div>

<div id = "search_result">
	<p class = "search_result">
		Your Search Result
	</p>

	<?php

		if($_POST){	//when there is a post display the result in a table
			echo '<table border="1"  cellpadding = "2" cellspacing = "10">';
			echo "<tr><td>ISBN</td><td>Title</td><td>Author</td><td>Edition</td><td>Year</td><td>Reserve</td></tr>";

			if(isset($_POST['categories'])){ //if it is a category post then
				$category = $_POST['categories'];
		
				if( $category == 'all' ){ //check if it is all, if it is than query the database and select all that books that are not reserved
					$query = "SELECT * FROM books WHERE Reserved = 'N'";
				}else{ // else query the book by that category and display if they are not reserved
					$query = "SELECT * FROM books WHERE Reserved = 'N' AND CategoryID = '$category'";
				}
	
			}
			if(isset ($_POST['title'])){ //if it is a title post then
				$title = $_POST['title']; //query the book by that title and display if they are not reserved
					$query = "SELECT * FROM books WHERE Reserved = 'N' AND BookTitle = '$title'";

			}
			if(isset ($_POST['author'])){ //if it is a author post then
				$author = $_POST['author']; //query the book by that author and display if they are not reserved
				$query = "SELECT * FROM books WHERE Reserved = 'N' AND Author = '$author'";
			}
	
			if(isset($_POST['categories']) || isset ($_POST['title']) || isset($_POST['author'])){ //display each of the result in a table
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
			
					echo "<form action = reserved_book.php method= POST>";
					echo "<input type = checkbox name = reserve[] value= ".$row[0]."></input>";
					echo("</td></tr>");
			}
			echo "</table>"; //close the table 
			echo "<br><br>";
			echo"<input type='submit' name='dsdsd' value='Reserve selected books'></input>"; //button to reserve book
			echo "</form>";
		}
	}
?>

</div>

<?php
	include 'footer.php'; //include footer
?>

</body>
</html>