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

    // Prepare a delete query
    $query = "DELETE FROM contactUs WHERE id = '$ticketID'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Ticket ID $ticketID has been deleted successfully.";
    } else {
        echo "Error deleting ticket: " . mysqli_error($conn);
    }
}
?>
