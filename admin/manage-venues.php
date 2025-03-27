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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>EMS | Manage Venues</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap{
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .delete-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: red;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            line-height: 30px;
            cursor: pointer;
            border: none;
        }

        .delete-btn:hover {
            background-color: darkred;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }
    </style>
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
                <h1 class="page-header">
                    Manage Venues
                    <!-- Add Venue Button -->
                    <a href="add-venue.php" class="btn btn-primary pull-right">Add Venue</a>
                </h1>
            </div>
        </div>
        <div class="row" style="margin-top:1%">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Venues
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Venue Name</th>
                                            <th>Location</th>
                                            <th>Description</th>
                                            <th>Capacity</th>
                                            <th>Action</th> <!-- New column for Edit/Delete buttons -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT venue_id, venue_name, location, description, capacity FROM tblvenues";
                                        $query = $dbh -> prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($row->venue_name); ?></td>
                                            <td><?php echo htmlentities($row->location); ?></td>
                                            <td><?php echo htmlentities($row->description); ?></td>
                                            <td><?php echo htmlentities($row->capacity); ?></td>
                                            <td>
                                                <!-- Action Buttons Container -->
                                                <div class="action-btns">
                                                    <!-- Edit button that links to edit-venue.php -->
                                                    <a href="edit-venue.php?venue_id=<?php echo htmlentities($row->venue_id); ?>">
                                                        <button type="button" class="btn btn-info">Edit</button>
                                                    </a>
                                                    
                                                    <!-- Delete button -->
                                                    <a href="delete-venue.php?venue_id=<?php echo htmlentities($row->venue_id); ?>" onclick="return confirm('Are you sure you want to delete this venue?');">
                                                        <button class="delete-btn">X</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                                $cnt++;
                                            }
                                        } 
                                        ?>                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>
</body>
</html>
<?php } ?>
