<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['cmid']) && ($_SESSION['role']=='ADM'||$_SESSION['role']=='COH')){
	$cmid = $_GET['cmid'];
    $query = mysqli_query($connection, "DELETE FROM callmodes WHERE modeid='$cmid'");
}

?>

<?php
if(isset($_POST['submit']) && ($_SESSION['role']=='ADM'||$_SESSION['role']=='COH')){
	$callmode = $_POST['CallMode'];
	$query = mysqli_query($connection, "INSERT INTO callmodes VALUES ('', '$callmode')");
}


if(isset($_POST['editsubmit'])){
    $callmode = $_POST['CallMode'];
    $modeid = $_POST['cmodeid'];
    $prequery = mysqli_query($connection, "DELETE FROM callmodes WHERE modeid='$modeid'");
    $query = mysqli_query($connection, "INSERT INTO callmodes VALUES ('$modeid', '$callmode')");
}

?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sidharth Machinaries">
    <link rel="shortcut icon" href="images/favicon.html">
    <title>Call Modes</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <script type="text/javascript">
        function populateForm(id) {
            var values = [];
            for(var i = 0; i < 2; i++) {
                values[i] = document.getElementById("row"+id).cells[i].innerHTML; 
            }
            document.getElementById("eModeName").value = values[1];
            document.getElementById("cmodeid").value = id;
        } 
    </script>
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <?php if($_SESSION['role'] == 'ADM' || $_SESSION['role'] == 'COH'){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4><b>Add/Edit Call Mode</b></h4>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" action="#">
                                    <div class="form-group ">
                                        <label for="ModeName" class="control-label col-lg-3">Call Mode</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="ModeName" type="text" name="CallMode" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
            <?php } ?>
            <div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Call Modes
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Call Mode</th>
                                    <?php if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'){ ?>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
								<?php
									$query = mysqli_query($connection, "SELECT * FROM callmodes");
									$rows = mysqli_num_rows($query);
									for($i=0 ; $i<$rows ; $i++){
										$result = mysqli_fetch_array($query);
								?>
                                <tr  id = "<?php echo "row".$result[0] ; ?>">
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $result[1] ; ?></td>
                                    <?php if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'){ ?>
                                    <td><a class="edit" href="#myModal-1" data-toggle="modal" id="<?php echo $result[0] ?>" onclick="populateForm(this.id)">Edit</a></td>
                                    <td><a class="delete" href="callmodes.php?cmid=<?php echo $result[0] ; ?>" onclick="return confirm('Delete CallMode?')">Delete</a></td>
                                    <?php } ?>
                                </tr>
								<?php } ?>
                                </tbody>
                            </table>
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Edit Call Mode</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal" method="post" role="form">
                                            <div class="form-group ">
                                        <label for="eModeName" class="control-label col-lg-3">Call Mode</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="eModeName" type="text" name="CallMode" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="cmodeid" type="hidden" name="cmodeid" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" name="editsubmit" type="submit">Save</button>
                                        </div>
                                    </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="js/jquery.js"></script>
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>