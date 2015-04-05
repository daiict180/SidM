<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if(isset($_POST['submit'])){
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];

  $id = $_SESSION['user'];
  $query = mysqli_query($connection, "UPDATE users SET fullname='$fullname', email='$email', mobile='$mobile' WHERE userid='$id'");
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
  <title>Profile</title>
  <!--Core CSS -->
  <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  <!--clock css-->
  <link href="js/css3clock/css/style.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/table-responsive.css" rel="stylesheet" />
  <link href="css/style1.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet"/>
  <script type="text/javascript">
  function editProfile() {
   // console.log(document.getElementById("uname").innerHTML);
    document.getElementById("euname").value = document.getElementById("uname").innerHTML;
    document.getElementById("euemail").value = document.getElementById("uemail").innerHTML;
    document.getElementById("eumobile").value = document.getElementById("umobile").innerHTML;
  }
  </script>
</head>
<?php include("includes/sidebar.php"); ?>
    <section id="main-content">
      <div class="wrapper">

        <div class="row">
          <div class="col-md-12">
            <section class="panel">
              <div class="panel-body profile-information">
               <div class="col-md-5">
                 <div class="profile-pic text-center">
                   <img src="images/lock_thumb.jpg" alt=""/>
                 </div>
                 <div class="row" style="margin-top:5%;margin-left:25%">
                  <a href="#myModal-2" data-toggle="modal" class="btn btn-primary" onclick="editProfile();">
                   Edit Profile
                 </a>
                 <a href="#myModal-1" data-toggle="modal" class="btn btn-danger">
                  Change Password
                </a>
              </div>
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                     <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                     <h4 class="modal-title">Change Password</h4>
                   </div>
                   <div class="modal-body">

                     <form class="form-horizontal" role="form">
                       <div class="form-group ">
                         <label for="pass" class="control-label col-lg-3">Old Password</label>
                         <div class="col-lg-6">
                           <input class="form-control " id="oldpass" type="password" name="password" required/>
                         </div>
                       </div>
                       <div class="form-group ">
                         <label for="pass" class="control-label col-lg-3">New Password</label>
                         <div class="col-lg-6">
                           <input class="form-control " id="newpass" type="password" name="password" required/>
                         </div>
                       </div>
                       <div class="form-group ">
                         <label for="cpass" class="control-label col-lg-3">Confirm Password</label>
                         <div class="col-lg-6">
                           <input class="form-control " id="confirmpass" type="password" name="confirmPassword" required/>
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
               </div>
             </div>
             <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                     <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                     <h4 class="modal-title">Edit Profile</h4>
                   </div>
                   <div class="modal-body">
                     <form class="cmxform form-horizontal " id="commentForm" method="post" action="#">
                       <div class="form-group ">
                         <label for="UserName" class="control-label col-lg-3">Full Name</label>
                         <div class="col-lg-6">
                           <input class="form-control " id="euname" type="text" name="fullname" required/>
                         </div>
                       </div>
                       <div class="form-group ">
                         <label for="uemail" class="control-label col-lg-3">Email-Id</label>
                         <div class="col-lg-6">
                           <input class="form-control " id="euemail" type="email" name="email" required/>
                         </div>
                       </div>
                       <div class="form-group ">
                         <label for="umobile" class="control-label col-lg-3">Mobile</label>
                         <div class="col-lg-6">
                           <input class="form-control " id="eumobile" name="mobile"/>
                         </div>
                       </div>
                       <div class="form-group">
                           <label for="ubranch" class="control-label col-lg-3">Avatar</label>
                           <div class="col-lg-6">
                               <input type="file" id="exampleInputFile" class="file-pos">
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
               </div>
             </div>

           </div>
           <div class="col-md-6">
                             <!-- <div class="profile-pic text-center">
                                 <img src="images/lock_thumb.jpg" alt=""/>
                               </div> -->
                               <?php
                               $id = $_SESSION['user'];
                                $query = mysqli_query($connection, "SELECT * FROM users WHERE userid='$id'");
                                $result = mysqli_fetch_array($query);
                               ?>
                               <div class="panel-body">
                                 <form class="cmxform form-horizontal " id="commentForm" method="get" action="#">
                                   <div class="form-group">
                                     <label for="UserName" class="control-label col-lg-3">Full Name:</label>
                                     <div class="col-lg-6" style="margin-top:7.5px" id="uname"><?php echo $result[1]; ?></div>
                                   </div>
                                   <div class="form-group ">
                                     <label for="uemail" class="control-label col-lg-3">Email-Id:</label>
                                     <div class="col-lg-6" style="margin-top:7.5px" id="uemail"><?php echo $result[2]; ?></div>
                                   </div>
                                   <div class="form-group ">
                                     <label for="umobile" class="control-label col-lg-3">Mobile:</label>
                                     <div class="col-lg-6" style="margin-top:7.5px" id="umobile"><?php echo $result[3]; ?></div>
                                   </div>
                                   <div class="form-group ">
                                     <label for="uactive" class="control-label col-lg-3">Active:</label>
                                     <div class="col-lg-6" style="margin-top:7.5px">
                                       <?php echo $result[5]; ?>
                                     </div>
                                   </div>
                                   <div class="form-group ">
                                     <label for="urole" class="control-label col-lg-3">Role:</label>
                                     <div class="col-lg-6" style="margin-top:7.5px">
                                       <?php echo $result[4]; ?>
                                     </div>
                                   </div>
                                   <div class="form-group ">
                                     <label for="ubranch" class="control-label col-lg-3">Branch:</label>
                                     <div class="col-lg-6" style="margin-top:7.5px">
                                       <?php echo $result[7]; ?>
                                     </div>
                                   </div>
                                 </div>
                               </div>

                             </div>
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
                           <!--script for this page-->
                         </body>

                         <!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
                         </html>
<?php require_once("includes/footer.php"); ?>