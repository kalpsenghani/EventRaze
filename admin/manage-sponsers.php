<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['adminsession'])==0)
{   
header('location:logout.php');
}
else{    
//Code for Category deletion 
if(isset($_GET['ssdel']))
{
$sid=$_GET['ssdel'];

$sql = "SELECT sponserLogo from tblsponsers WHERE id=:id";
$query = $dbh -> prepare($sql);
$query -> bindParam(':id',$sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
$path="sponsers/".$row->sponserLogo;
}} 
unlink($path);
$sql = "delete from tblsponsers  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$sid, PDO::PARAM_STR);
$query -> execute();

$_SESSION['delmsg']="Sponser deleted";

} 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>EMS | Manage Sponsors</title>

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
</style>
</head>
<body>
<div id="wrapper">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<!-- / Header -->
<?php include_once('includes/header.php');?>
<!-- / Leftbar -->
<?php include_once('includes/leftbar.php');?>
</nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Manage Sponsors</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div align="right">
              <a href="add-sponser.php" class="btn btn-primary btn-icon-split" >
                    <span class="icon text-white-50">
                      <i class="fa fa-check"></i>
                    </span>
                    <span class="text">Add Sponsor</span>
                  </a></div>
            <!-- /.row -->
            <div class="row" style="margin-top:1%">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Manage Sponsors
                        </div>

 <?php if($_SESSION['delmsg']!="")
    {?>
<div class="errorWrap">
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
<?php } ?>



                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sponsor</th>
                                        <th>Logo</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$sql = "SELECT id,sponserName,sponserLogo,postingDate from tblsponsers";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{ 
?>

<tr >
<td><?php echo htmlentities($cnt);?></td>
<td><?php echo htmlentities($row->sponserName);?></td>
<td><img src="sponsers/<?php echo htmlentities($row->sponserLogo);?>" width="180" height="100" /></td>
<td><?php echo htmlentities($row->postingDate);?></td>
<td>
<a href="edit-sponser.php?sid=<?php echo htmlentities($row->id);?>">
<button type="button" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></button>
</a>
<a href="manage-sponsers.php?ssdel=<?php echo htmlentities($row->id);?>"  onclick="return confirm('Are you sure you want to delete?');"><button type="button" class="btn btn-danger btn-circle" style="margin-left:4px;"><i class="fa fa-times"></i>
                            </button>    
                            </a></td>
</tr>
        <?php $cnt++;
    }} ?>                         

                                </tbody>
                            </table>
                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
