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
    if(isset($_POST['submit'])) {
        // Fetch form data
        $venue_name = $_POST['venue_name'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $capacity = $_POST['capacity'];

        // Insert data into the database
        $sql = "INSERT INTO tblvenues (venue_name, location, description, capacity) VALUES (:venue_name, :location, :description, :capacity)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':venue_name', $venue_name, PDO::PARAM_STR);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':capacity', $capacity, PDO::PARAM_INT);

        // Execute the query
        if($query->execute()) {
            $msg = "Venue added successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>EMS | Add Venue</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body>
<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/leftbar.php'); ?>
</nav>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Venue</h1>
        </div>
    </div>

    <div class="row" style="margin-top:1%">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Venue Details
                </div>

                <div class="panel-body">
                    <!-- Display success or error message -->
                    <?php if(isset($msg)) { ?>
                        <div class="succWrap"><?php echo htmlentities($msg); ?></div>
                    <?php } else if(isset($error)) { ?>
                        <div class="errorWrap"><?php echo htmlentities($error); ?></div>
                    <?php } ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="venue_name">Venue Name</label>
                            <input type="text" name="venue_name" id="venue_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacity</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Add Venue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>

</body>
</html>
