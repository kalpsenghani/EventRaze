<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
    header('location:logout.php');
}
else{
    // Check if the venue_id is set in the URL
    if(isset($_GET['venue_id'])) {
        $venue_id = $_GET['venue_id'];
        
        // Fetch the venue details from the database
        $sql = "SELECT * FROM tblvenues WHERE venue_id = :venue_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':venue_id', $venue_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        if(!$result) {
            // If the venue is not found, redirect to the manage venues page
            header('location:manage-venues.php');
            exit;
        }
    }

    // Check if the form is submitted
    if(isset($_POST['update'])) {
        $venue_name = $_POST['venue_name'];
        $location = $_POST['location'];
        $capacity = $_POST['capacity'];
        $description = $_POST['description'];

        // Update the venue details in the database
        $sql = "UPDATE tblvenues SET venue_name = :venue_name, location = :location, capacity = :capacity, description = :description WHERE venue_id = :venue_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':venue_name', $venue_name, PDO::PARAM_STR);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':venue_id', $venue_id, PDO::PARAM_INT);

        if($query->execute()) {
            // If the update is successful, redirect to the manage venues page
            $_SESSION['msg'] = "Venue details updated successfully";
            header('location:manage-venues.php');
            exit;
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>EMS | Edit Venue</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <!-- / Header -->
        <?php include_once('includes/header.php'); ?>
        <!-- / Leftbar -->
        <?php include_once('includes/leftbar.php'); ?>
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Venue</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Venue Details
                    </div>

                    <div class="panel-body">
                        <?php if(isset($_SESSION['error'])) { ?>
                            <div class="errorWrap">
                                <strong>Error:</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['msg'])) { ?>
                            <div class="succWrap">
                                <strong>Success:</strong> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
                            </div>
                        <?php } ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="venue_name">Venue Name</label>
                                <input type="text" class="form-control" id="venue_name" name="venue_name" value="<?php echo htmlentities($result->venue_name); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlentities($result->location); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacity</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo htmlentities($result->capacity); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlentities($result->description); ?></textarea>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update Venue</button>
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
<?php } ?>
