<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if($_SESSION['role']=='SAE')
    redirect_to("dashboard.php");

if(isset($_POST['submit'])){
	$cname = mysql_prep($_POST['company'],$connection);
	$contact = mysql_prep($_POST['contact'],$connection);
	$designation = mysql_prep($_POST['designation'],$connection);
	$bphone = mysql_prep($_POST['bphone'],$connection);
	$pphone = mysql_prep($_POST['pphone'],$connection);
	$mobile = mysql_prep($_POST['mobile'],$connection);
	$email = mysql_prep($_POST['email'],$connection);
	
    $pre = mysqli_query($connection, "SELECT branch FROM companies WHERE companyid='$cname'");
    $res = mysqli_fetch_array($pre);

    if(getbranchbyid($_SESSION['user'], $connection)==$res['branch'] && $_SESSION['role']=='BRH')
	   $query = mysqli_query($connection, "INSERT INTO companycontacts VALUES ('','$cname', '$contact', '$designation', '$bphone', '$pphone', '$mobile', '$email')");
    if($_SESSION['role']=='COH'||$_SESSION['role']=='ADM')
        $query = mysqli_query($connection, "INSERT INTO companycontacts VALUES ('','$cname', '$contact', '$designation', '$bphone', '$pphone', '$mobile', '$email')");
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
    <title>Company Contacts</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4><b>Add Company Contact</b></h4>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" onsubmit="return modalCall()" action="#">
                                    <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="contactCompany" name="company" required>
                                                <?php
													$exec = "SELECT * FROM companies ";
                                                    if($_SESSION['role'] == 'BRH'){
                                                        $branch = getbranchbyid($_SESSION['user'], $connection);
                                                        $exec = $exec."WHERE branch='$branch'";
                                                    }
                                                    $query = mysqli_query($connection, $exec);
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"> <?php echo $result[1] ; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contactName" class="control-label col-lg-3">Contact Name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="contactName" type="text" name="contact" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cdesig" class="control-label col-lg-3">Contact Designation</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="cdesig" type="text" name="designation" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="bphone" class="control-label col-lg-3">Business Phone</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="bphone" type="text" name="bphone" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="pphone" class="control-label col-lg-3">Personal Phone</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="pphone" type="text" name="pphone" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mobile" class="control-label col-lg-3">Mobile</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mobile" type="text" name="mobile" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccemail" class="control-label col-lg-3">Email-Id</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="ccemail" type="email" name="email" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                            <a href="companycontacts.php"><button class="btn btn-default" type="button">Cancel</button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Wrong Input!!!</h4>
                                        </div>
                                        <div class="modal-body" >
                                        <h4><b><i><div  id = "modaltext"></div></h4>

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
<script type="text/javascript">
    function modalCall() {
        var error;
        var phone2 = document.getElementById("bphone").value;
        var mobile = document.getElementById("mobile").value;
        var bphone = document.getElementById("pphone").value;
        var flag = false;
        if(mobile.length>0 && isNaN(mobile)) {
            flag = true;
            error = "Mobile should be numeric!!!";
        }
        if(bphone.length>0 && isNaN(bphone)) {
            flag = true;
            error = "Personal Phone should be numeric!!!";
        }
        if(phone2.length>0 && isNaN(phone2)) {
            flag = true;
            error = "Business Phone should be numeric!!!";
        }
        if(flag) {
            //alert(error);
            document.getElementById("modaltext").innerHTML = error;
            $('#myModal3').modal('show'); 
            return false;   
        }
        return true;
        

    }
</script>

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
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>