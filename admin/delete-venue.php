<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Check if the admin is logged in
if(strlen($_SESSION['adminsession'])==0)
{   
    header('location:logout.php');
}
else {
    // Check if the venue_id is provided
    if(isset($_GET['venue_id'])) {
        $venue_id = $_GET['venue_id'];

        // SQL query to delete the venue by its ID
        $sql = "DELETE FROM tblvenues WHERE venue_id = :venue_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':venue_id', $venue_id, PDO::PARAM_INT);

        // Execute the query
        if($query->execute()) {
            $msg = "Venue deleted successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }

    // Redirect to the Manage Venues page with the message
    header('location:manage-venues.php');
}
?>
