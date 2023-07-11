<?php
	$servername = "localhost";
	$username = "miloSquad";
	$password = "12345";
	$dbname = "omodb";
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Function to delete a ticket based on the ID
	function deleteTicket($conn, $id) {
		$query = "DELETE FROM contactUs WHERE id = '$id'";
		if (mysqli_query($conn, $query)) {
			echo "Ticket ID $id has been deleted successfully.";
			} else {
			echo "Error deleting ticket: " . mysqli_error($conn);
		}
	}
	
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
		
		// Prepare a SQL query to fetch the ticket IDs for the given email
		$query = "SELECT id, comments FROM contactUs WHERE email = '$email'";
		
		// Execute the query
		$result = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($result) > 0) {
			// Display the ticket ID and message
			echo "Tickets for $email:<br>";
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id'];
				echo "Ticket ID: $id";
				echo "Message: " . $row['comments'] . "<br><br>";
				echo " <a href='updateTicket.php?id=$id'>Update</a>";
				echo " <a href='deleteTicket.php?id=$id'>Delete</a><br>";
			}
			} else {
			echo "No tickets found for $email";
		}
		
		// echo "Ticket ID: " . $row['id'] . "<br>";
		// echo "Message: " . $row['comments'] . "<br><br>";
        // }
		// } else {
        // echo "No tickets found for $email";
		// }
		
		
		// Free the result set
		mysqli_free_result($result);
	}
	
	// Close the database connection
	mysqli_close($conn);
?>

<!-- HTML form to enter the email -->
<form action="" method="POST">
<label for="email">Enter Email:</label>
<input type="text" name="email" id="email" required>
<input type="submit" name="submit" value="Submit">
</form>
