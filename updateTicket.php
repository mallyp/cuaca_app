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

// Check if the ticket ID is provided
if (isset($_GET['id'])) {
    $ticketID = $_GET['id'];

    // Check if the form is submitted for updating
    if (isset($_POST['submit'])) {
        // Retrieve the updated comment from the form
        $updatedComment = $_POST['comment'];

        // Prepare an update query
        $query = "UPDATE contactUs SET comments = '$updatedComment' WHERE id = '$ticketID'";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo "Ticket ID $ticketID has been updated successfully.";
        } else {
            echo "Error updating ticket: " . mysqli_error($conn);
        }
    }

    // Retrieve the existing comment for the ticket
    $query = "SELECT comments FROM contactUs WHERE id = '$ticketID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $existingComment = $row['comments'];
    mysqli_free_result($result);
}
?>

<!-- HTML form to update the ticket comment -->
<form action="" method="POST">
    <label for="comment">Ticket Comment:</label>
    <textarea name="comment" id="comment" rows="4" cols="50"><?php echo $existingComment; ?></textarea>
    <br>
    <input type="submit" name="submit" value="Update">
</form>
