<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['company'])){
  $companyid = $_GET['company'];
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
    <title>View Details</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/table-responsive.css" rel="stylesheet" />
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <style type="text/css">
      .wrapword{
        white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
        white-space: -webkit-pre-wrap; /*Chrome & Safari */ 
        white-space: -pre-wrap;      /* Opera 4-6 */
        white-space: -o-pre-wrap;    /* Opera 7 */
        white-space: pre-wrap;       /* css-3 */
        word-wrap: break-word;       /* Internet Explorer 5.5+ */
        word-break: break-all;
        white-space: normal;
      }
    </style>
</head>
<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    <img src="images/logo1.png" alt="">
                </a>
                <div class="sidebar-toggle-box">
                    <!--<i class="fa fa-angle-left fa-2x" style="margin-left:9px; margin-top:3px"></i> -->
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="images/avatar1_small.jpg">
                            <span class="username"><?php echo getnamebyid($_SESSION['user'], $connection) ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class="fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                            <li><a href="logout.php"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="companies.php">
                        <i class="fa fa-university"></i>
                        <span>Companies</span>
                    </a>
                </li>
                <li>
                    <a href="companycontacts.php">
                        <i class="fa fa-info"></i>
                        <span>Company Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="setupinfo.php">
                        <i class="fa fa-cog"></i>
                        <span>Setup Information</span>
                    </a>
                </li>
                <li>
                    <a href="leads.php">
                        <i class="fa fa-magnet"></i>
                        <span>Leads</span>
                    </a>
                </li>
                <li>
                    <a href="opportunities.php">
                        <i class="fa fa-level-up"></i>
                        <span>Opportunities</span>
                    </a>
                </li>
                <li>
                    <a href="calls.php">
                        <i class="fa fa-mobile"></i>
                        <span>Calls</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bar-chart"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub">
                        <li><a href="general.html">Monthly Sales</a></li>
                        <li><a href="buttons.html">Open Opportunities</a></li>
                        <li><a href="widget.html">Upcoming calls</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Masters</span>
                    </a>
                    <ul class="sub">
                        <li><a href="machines.php">Machines</a></li>
                        <li><a href="users.php">Users</a></li>
                        <li><a href="segments.php">Segments</a></li>
                        <li><a href="branches.php">Branches</a></li>
                        <li><a href="sources.php">Sources</a></li>
                        <li><a href="callmodes.php">Call Modes</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Utilities</span>
                    </a>
                    <ul class="sub">
                        <li><a href="basic_table.html">Group Email/Labels</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <?php
          $query = mysqli_query($connection, "SELECT * FROM companies WHERE companyid='$companyid'");
          $result = mysqli_fetch_array($query);
        ?>
        <section id="main-content">
            <section class="wrapper">
                <!-- page start-->

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <h4><b><?php echo $result[1]; ?> - Company details</b></h4>

                            </header>
                            <div class="panel-body">
                                <div class=" form">
                                    <form class="cmxform form-horizontal " id="commentForm" method="get" action="#">
                                        <div class="form-group ">
                                            <label for="cname" class="control-label col-lg-3 wrapword">Company Name</label>
                                            <div class="col-lg-3 wrapword" style="margin-top:7px">
                                              <?php echo $result[1]; ?>
                                            </div>
                                          <label for="ctype" class="control-label col-lg-3 wrapword">Type</label>
                                          <div class="col-lg-3 wrapword" style="margin-top:7px">
                                              <?php echo $result[11]; ?>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                        <label for="coname" class="control-label col-lg-3 wrapword">Owner Name</label>
                                        <div class="col-lg-3 wrapword" style="margin-top:7px">
                                          <?php echo $result[2]; ?>
                                      </div>
                                      <label for="cbranch" class="control-label col-lg-3 wrapword">Branch</label>
                                      <div class="col-lg-3 wrapword" style="margin-top:7px">
                                          <?php echo $result[12]; ?>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                    <label for="cadd1" class="control-label col-lg-3 wrapword">Address1</label>
                                    <div class="col-lg-3 wrapword" style="margin-top:7px">
                                      <?php echo $result[3]; ?>
                                  </div>
                                  <label for="cemail" class="control-label col-lg-3 wrapword">Email-Id</label>
                                  <div class="col-lg-3 wrapword" style="margin-top:7px">
                                      <?php echo $result[13]; ?>
                                  </div>
                              </div>
                              <div class="form-group ">
                                <label for="cadd2" class="control-label col-lg-3 wrapword">Address2</label>
                                <div class="col-lg-3 wrapword" style="margin-top:7px">
                                  <?php echo $result[4]; ?>
                              </div>
                              <label for="cbphone" class="control-label col-lg-3 wrapword">Business Phone</label>
                              <div class="col-lg-3 wrapword" style="margin-top:7px">
                                  <?php echo $result[14]; ?>
                              </div>
                          </div>
                          <div class="form-group ">
                            <label for="ccity" class="control-label col-lg-3 wrapword">City</label>
                            <div class="col-lg-3 wrapword" style="margin-top:7px">
                              <?php echo $result[5]; ?>
                          </div>
                          <label for="cmobile" class="control-label col-lg-3 wrapword">Mobile</label>
                          <div class="col-lg-3 wrapword" style="margin-top:7px">
                              <?php echo $result[15]; ?>
                          </div>
                      </div>
                      <div class="form-group ">
                        <label for="cpin" class="control-label col-lg-3 wrapword">Pincode</label>
                        <div class="col-lg-3 wrapword" style="margin-top:7px">
                          <?php echo $result[6]; ?>
                      </div>
                      <label for="cphone2" class="control-label col-lg-3 wrapword">Phone2</label>
                      <div class="col-lg-3 wrapword" style="margin-top:7px">
                          <?php echo $result[16]; ?>
                      </div>
                  </div>
                  <div class="form-group ">
                    <label for="cstate" class="control-label col-lg-3 wrapword">State</label>
                    <div class="col-lg-3 wrapword" style="margin-top:7px">
                      <?php echo $result[7]; ?>
                  </div>
                  <label for="cfax" class="control-label col-lg-3 wrapword">Fax</label>
                  <div class="col-lg-3 wrapword" style="margin-top:7px">
                      <?php echo $result[17]; ?>
                  </div>
              </div>
              <div class="form-group ">
                <label for="ccountry" class="control-label col-lg-3 wrapword">Country</label>
                <div class="col-lg-3 wrapword" style="margin-top:7px">
                  <?php echo $result[8]; ?>
              </div>
              <label for="curl" class="control-label col-lg-3 wrapword">Website</label>
              <div class="col-lg-3 wrapword" style="margin-top:7px">
                  <?php echo $result[18]; ?>
              </div>
          </div>
          <div class="form-group ">
            <label for="csource" class="control-label col-lg-3 wrapword">Source</label>
            <div class="col-lg-3 wrapword" style="margin-top:7px">
              <?php echo $result[9]; ?>
          </div>
          <label for="csegment" class="control-label col-lg-3 wrapword">Segment</label>
          <div class="col-lg-3 wrapword" style="margin-top:7px">
              <?php echo $result[19]; ?>
          </div>
      </div>
      <div class="form-group ">
        <label for="cremarks" class="col-lg-3 wrapword control-label" style="margin-top:0px">Remarks</label>
          <div class="col-lg-3 wrapword" style="margin-top:7px">
             <?php echo $result[10]; ?>
          </div>
      <label for="cexperience" class="col-lg-3 wrapword control-label" style="margin-top:0px">Experience</label>
          <div class="col-lg-3 wrapword" style="margin-top:7px">
              <?php echo $result[20]; ?>
          </div>
  </div>


</form>
</div>

</div>
</section>
</div>
</div>

<section class="panel" style="width:100%">
    <header class="panel-heading tab-bg-dark-navy-blue ">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home">Contacts</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#about">Machines</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#profile">Leads</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#contact">Opportunities</a>
            </li>

            <li class="">
                <a data-toggle="tab" href="#calls">Calls</a>
            </li>
        </ul>
    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div id="home" class="tab-pane active">
             <div class="panel-body">
                 <section id="flip-scroll">
                     <table class="table table-bordered table-striped table-condensed cf">
                         <thead class="cf">
                             <tr>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Business Phone</th>
                                 <th>Personal Phone</th>
                                 <th>Mobile</th>
                                 <th>Email</th>
                             </tr>
                         </thead>
                         <tbody>
                         <?php
                            $query = mysqli_query($connection, "SELECT * FROM companycontacts WHERE company = '$companyid'");
                            $rows = mysqli_num_rows($query);
                            for($i=0; $i<$rows ; $i++){
                              $result = mysqli_fetch_array($query);
                         ?>
                             <tr>
                                 <td><?php echo $result[2]; ?></td>
                                 <td><?php echo $result[3]; ?></td>
                                 <td class="numeric"><?php echo $result[4]; ?></td>
                                 <td class="numeric"><?php echo $result[5]; ?></td>
                                 <td class="numeric"><?php echo $result[6]; ?></td>
                                 <td class="numeric"><?php echo $result[7]; ?></td>
                             </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </section>
             </div>
         </div>
         <div id="about" class="tab-pane">
            <div id="about" class="tab-pane">
                <div class="panel-body">
                   <section id="flip-scroll">
                    <table class="table table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                            <tr>
                                <th>Date</th>
                                <th>Manufacturer</th>
                                <th>Machine Name</th>
                                <th>Machine No.</th>
                                <th>Ink</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                              $query = mysqli_query($connection, "SELECT * FROM setupinformation WHERE company = '$companyid'");
                              $rows = mysqli_num_rows($query);
                              for($i=0; $i<$rows ; $i++){
                                $result = mysqli_fetch_array($query);
                            ?>
                            <tr>
                                <td><?php echo $result[3]; ?></td>
                                <td><?php echo $result[2]; ?></td>
                                <td class="numeric"><?php echo $result[5]; ?></td>
                                <td class="numeric"><?php echo $result[9]; ?></td>
                                <td class="numeric"><?php echo $result[11]; ?></td>
                                <td class="numeric"><?php echo $result[13]; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <div id="profile" class="tab-pane">
        <div id="profile" class="tab-pane">
            <div class="panel-body">
                <section id="flip-scroll">
                    <table class="table table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                            <tr>
                                <th>Created Date</th>
                                <th>Assigned to</th>
                                <th>Created by</th>
                                <th>Remarks</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                              $query = mysqli_query($connection, "SELECT * FROM leads WHERE customer = '$companyid'");
                              $rows = mysqli_num_rows($query);
                              for($i=0; $i<$rows ; $i++){
                                $result = mysqli_fetch_array($query);
                            ?>
                            <tr>
                                <td><?php echo $result[7]; ?></td>
                                <td><?php echo getnamebyid($result[2],$connection); ?></td>
                                <td class="numeric"><?php echo getnamebyid($result[8], $connection); ?></td>
                                <td class="numeric"><?php echo $result[6]; ?></td>
                                <td class="numeric"><?php echo $result[3]; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
    <div id="contact" class="tab-pane">
        <div id="contact" class="tab-pane">
            <div id="contact" class="tab-pane">
                <div class="panel-body">
                    <section id="flip-scroll">
                        <table class="table table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <th>Opportunity Name</th>
                                    <th>Created on</th>
                                    <th>Assigned to</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              $query = mysqli_query($connection, "SELECT * FROM opportunities WHERE customer = '$companyid'");
                              $rows = mysqli_num_rows($query);
                              for($i=0; $i<$rows ; $i++){
                                $result = mysqli_fetch_array($query);
                            ?>
                                <tr>
                                    <td><?php echo $result[1]; ?></td>
                                    <td><?php echo $result[5]; ?></td>
                                    <td class="numeric"><?php echo getnamebyid($result[7],$connection); ?></td>
                                      <td class="numeric"><?php echo $result[8]; ?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <div id="calls" class="tab-pane">
        <div id="calls" class="tab-pane">
            <div id="calls" class="tab-pane">
                <div class="panel-body">
                    <section id="flip-scroll">
                        <table class="table table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                                <tr>
                                    <th>Date</th>
                                    <th>Mode</th>
                                    <th>For</th>
                                    <th>By</th>
                                    <th>Notes</th>
                                    <th>Next follow up</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              $query = mysqli_query($connection, "SELECT * FROM calls WHERE customer = '$companyid'");
                              $rows = mysqli_num_rows($query);
                              for($i=0; $i<$rows ; $i++){
                                $result = mysqli_fetch_array($query);
                            ?>
                                <tr>
                                    <td><?php echo $result[1]; ?></td>
                                    <td><?php echo $result[2]; ?></td>
                                    <td class="numeric"><?php echo $result[4]; ?></td>
                                    <td class="numeric"><?php echo getnamebyid($result[3], $connection); ?></td>
                                    <td class="numeric"><?php echo $result[8]; ?></td>
                                    <td class="numeric"><?php echo $result[9]; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

    </div>
</div>

</div>
</div>



</section>
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
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>

<?php require_once("includes/footer.php"); ?>