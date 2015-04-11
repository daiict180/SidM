<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>
<?php include("MailChimp.php"); ?>

<?php

$address = "India";


if($_SESSION['role']!='ADM' && $_SESSION['role']!='COH' && $_SESSION['role']!='BRH'){
    redirect_to("dashboard.php");
} 

if(isset($_POST['submit'])){
	$name = mysql_prep($_POST['name'],$connection);
	$type = mysql_prep($_POST['type'],$connection);
	$oname = mysql_prep($_POST['oname'],$connection);
	$branch = mysql_prep($_POST['branch'],$connection);
	$add1 = mysql_prep($_POST['add1'], $connection);
	$email = mysql_prep($_POST['email'],$connection);
	$add2 = mysql_prep($_POST['add2'],$connection);
	$bphone = mysql_prep($_POST['bphone'],$connection);
	$city = mysql_prep($_POST['city'],$connection);
	$mobile = mysql_prep($_POST['mobile'],$connection);
	$pin = intval($_POST['pin']);
	$phone2 = mysql_prep($_POST['phone2'],$connection);
	$state = mysql_prep($_POST['state'],$connection);
	$fax = mysql_prep($_POST['fax'],$connection);
	$country = mysql_prep($_POST['country'],$connection);
	$url = mysql_prep($_POST['url'],$connection);
	$source = mysql_prep($_POST['source'],$connection);
	$segment = mysql_prep($_POST['segment'],$connection);
	$remarks = mysql_prep($_POST['remarks'],$connection);
	$experience = mysql_prep($_POST['experience'],$connection);

    $address = $add1.",".$add2.",".$city.",".$state;
    
    $data_arr = geocode($address);
 
    // if able to geocode the address
    if($data_arr){
         
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];
    }

	if($_SESSION['role']=='BRH' && $branch == getbranchbyid($_SESSION['user'], $connection))
	   $query = mysqli_query($connection, "INSERT INTO companies VALUES ('','$name', '$oname', '$add1', '$add2', '$city', $pin, '$state', '$country', '$source', '$remarks', '$type', '$branch', '$email', '$bphone', '$mobile', '$phone2', '$fax', '$url', '$segment', '$experience', '$latitude', '$longitude')");
    else if($_SESSION['role']=='COH' || $_SESSION['role']=='ADM')
        $query = mysqli_query($connection, "INSERT INTO companies VALUES ('','$name', '$oname', '$add1', '$add2', '$city', $pin, '$state', '$country', '$source', '$remarks', '$type', '$branch', '$email', '$bphone', '$mobile', '$phone2', '$fax', '$url', '$segment', '$experience', '$latitude', '$longitude')");

    $api = '834fa0f70901971dedfc9919ecedb094-us10';
    $MailChimp = new \Drewm\MailChimp($api);
    $result = $MailChimp->call('lists/subscribe', array(
                    'id'                => 'f2131d3e92',
                    'email'             => array('email'=>$email),
                    //'merge_vars'        => array('FNAME'=>'Davy', 'LNAME'=>'Jones'),
                    'double_optin'      => false,
                    'update_existing'   => true,
                    'replace_interests' => false,
                    'send_welcome'      => false,
                ));
    
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
    <title>Companies</title>
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
                            <h4><b>Add new company</b></h4>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" action="#" onsubmit="return modalCall()">
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Company Name</label>
                                        <div class="col-lg-3">
                                            <input class=" form-control" id="cname" name="name" minlength="2" type="text" required />
                                        </div>
                                        <label for="ctype" class="control-label col-lg-3">Type</label>
                                        <div class="col-lg-3">
                                            <select class="form-control"  id="ctype" name="type" required>
                                                <option value="Our Machine Holder">Our Machine Holder</option>
                                                <option value="Prospect">Prospect</option>
                                                <option value="Lead">Lead</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="coname" class="control-label col-lg-3">Owner Name</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="coname" type="text" name="oname" />
                                        </div>
                                        <label for="cbranch" class="control-label col-lg-3">Branch</label>
                                        <div class="col-lg-3">
                                            <select class="form-control"  id="cbranch" name="branch" required>
                                                <?php
                                                    $exec = "SELECT branchname FROM branches ";
                                                    if($_SESSION['role'] == 'BRH'){
                                                        $branch = getbranchbyid($_SESSION['user'], $connection);
                                                        $exec = $exec."WHERE branchname='$branch'";
                                                    }
													$query = mysqli_query($connection, $exec);
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cadd1" class="control-label col-lg-3">Address1</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cadd1" type="text" name="add1" />
                                        </div>
                                        <label for="cemail" class="control-label col-lg-3">Email-Id</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cemail" type="email" name="email" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cadd2" class="control-label col-lg-3">Address2</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cadd2" type="text" name="add2" />
                                        </div>
                                        <label for="cbphone" class="control-label col-lg-3">Business Phone</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cbphone" type="text" name="bphone" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccity" class="control-label col-lg-3">City</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="ccity" type="text" name="city" />
                                        </div>
                                        <label for="cmobile" class="control-label col-lg-3">Mobile</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cmobile" type="text" name="mobile" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cpin" class="control-label col-lg-3">Pincode</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cpin" name="pin" />
                                        </div>
                                        <label for="cphone2" class="control-label col-lg-3">Phone2</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cphone2" type="text" name="phone2" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cstate" class="control-label col-lg-3">State</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cstate" type="text" name="state" />
                                        </div>
                                        <label for="cfax" class="control-label col-lg-3">Fax</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="cfax" type="text" name="fax" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccountry" class="control-label col-lg-3">Country</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="ccountry" type="text" name="country" />
                                        </div>
                                         <label for="curl" class="control-label col-lg-3">Website</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="curl" type="url" name="url" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="csource" class="control-label col-lg-3">Source</label>
                                        <div class="col-lg-3">
                                            <select class="form-control"  id="csource" name="source" required>
                                                <?php
													$query = mysqli_query($connection, "SELECT value FROM sources");
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
                                            	<?php }  ?>
                                            </select>
                                        </div>
                                        <label for="csegment" class="control-label col-lg-3">Segment</label>
                                        <div class="col-lg-3">
                                            <select class="form-control"  id="csegment" name="segment" required>
                                                <?php
													$query = mysqli_query($connection, "SELECT segment FROM segments");
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
													<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cremarks" class="control-label col-lg-3">Remarks</label>
                                        <div class="col-lg-3">
                                            <textarea class="form-control " id="cremarks" name="remarks"></textarea>
                                        </div>
                                        <label for="cexperience" class="control-label col-lg-3">Experience</label>
                                        <div class="col-lg-3">
                                            <textarea class="form-control " id="cexperience" name="experience"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                            <a href="companies.php"><button class="btn btn-default" type="button">Cancel</button></a>
                                        </div>
                                    </div>
                                </form>
                                <!-- <button class="btn btn-primary"  onclick="modalCall()" >modal</button> -->
                                

           
                            <!-- Modal -->
                            <!-- <button class="btn btn-primary" onclick="modalCall()">Modal</button> -->
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
                            <!-- modal -->
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
        var phone2 = document.getElementById("cphone2").value;
        var mobile = document.getElementById("cmobile").value;
        var bphone = document.getElementById("cbphone").value;
        var flag = false;
        if(phone2.length>0 && isNaN(phone2)) {
            flag = true;
            error = "phone2 should be numeric!!!";
        }
        if(mobile.length>0 && isNaN(mobile)) {
            flag = true;
            error = "mobile should be numeric!!!";
        }
        if(bphone.length>0 && isNaN(bphone)) {
            flag = true;
            error = "bphone should be numeric!!!";
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