<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['oid']) && ($_SESSION['role'] == 'BRH' || $_SESSION['role'] == 'COH')){
	$oid = $_GET['oid'];
    $pre = mysqli_query($connection, "SELECT branch FROM opportunities WHERE opportunityid='$oid'");
    $res = mysqli_fetch_array($pre);
    if($_SESSION['role'] == 'BRH' && $res['branch'] == getbranchbyid($_SESSION['user'], $connection))
        $query = mysqli_query($connection, "DELETE FROM opportunities WHERE opportunityid='$oid'");
    if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM')
        $query = mysqli_query($connection, "DELETE FROM opportunities WHERE opportunityid='$oid'");
}

?>

<?php

if(isset($_POST['editsubmit'])){
    $oppname = mysql_prep($_POST['oppName'], $connection);
    $company = mysql_prep($_POST['company'], $connection);
    $lead = mysql_prep($_POST['lead'], $connection);
    $crdate = mysql_prep($_POST['crdate'], $connection);
    $user = mysql_prep($_POST['user'], $connection);
    $assignedto = mysql_prep($_POST['assignedto'], $connection);
    $status = mysql_prep($_POST['status'], $connection);
    $stage = mysql_prep($_POST['stage'], $connection);
    $source = mysql_prep($_POST['source'], $connection);
    $amount = intval($_POST['amount']);
    $interest = mysql_prep($_POST['interest'], $connection);
    $cdate = mysql_prep($_POST['cdate'], $connection);
    $oremarks = mysql_prep($_POST['oremarks'], $connection);
    $branch = getbranchbyid($assignedto , $connection);
    $oppid = intval($_POST['oppid']);

    $prequery = mysqli_query($connection, "DELETE FROM opportunities WHERE opportunityid='$oppid'");
    $query = mysqli_query($connection, "INSERT INTO opportunities VALUES ('','$oppname', '$company', '$lead', '$branch', STR_TO_DATE('$crdate', '%Y-%m-%d'), '$user', '$assignedto', '$status', '$stage', '$source', $amount, '$interest', STR_TO_DATE('$cdate', '%Y-%m-%d'), '$oremarks')");

}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Opportunities</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-datetimepicker/css/datetimepicker.css" />

    <link rel="stylesheet" type="text/css" href="js/jquery-multi-select/css/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="js/jquery-tags-input/jquery.tagsinput.css" />

    <link rel="stylesheet" type="text/css" href="js/select2/select2.css" />

    <!--dynamic table-->
    <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <script type="text/javascript">
        function populateForm(id) {
            var values = [];
            for(var i = 0; i < 16; i++) {
                values[i] = document.getElementById("row"+id).cells[i].innerHTML; 
            }

            document.getElementById("oppid").value = id;
            document.getElementById("oppName").value = values[0];
            document.getElementById("contactCompany").value = values[15];
            document.getElementById("crdate").value = values[3];
            document.getElementById("assignedto").value = values[14];
            document.getElementById("status").value = values[5];
            document.getElementById("cdate").value = values[6];
            document.getElementById("lead").value = values[7];
            document.getElementById("user").value = values[8];
            document.getElementById("stage").value = values[9];
            document.getElementById("source").value = values[10];
            document.getElementById("amount").value = values[11];
            document.getElementById("interest").value = values[12];
            document.getElementById("oremarks").value = values[13];
            
            
        }
        function searchRows(tblId) {
            var tbl = document.getElementById(tblId);
            var headRow = tbl.rows[1];
            var arrayOfHTxt = new Array();
            var arrayOfHtxtCellIndex = new Array();

            for (var v = 0; v < headRow.cells.length-2; v++) {
             if (headRow.cells[v].getElementsByTagName('input')[0]) {
             var Htxtbox = headRow.cells[v].getElementsByTagName('input')[0];
              if (Htxtbox.value.replace(/^\s+|\s+$/g, '') != '') {
                arrayOfHTxt.push(Htxtbox.value.replace(/^\s+|\s+$/g, ''));
                arrayOfHtxtCellIndex.push(v);
              }
             }
            }

            for (var i = 2; i < tbl.rows.length; i++) {
             
                tbl.rows[i].style.display = 'table-row';
             
                for (var v = 0; v < arrayOfHTxt.length; v++) {
             
                    var CurCell = tbl.rows[i].cells[arrayOfHtxtCellIndex[v]];
             
                    var CurCont = CurCell.innerHTML.replace(/<[^>]+>/g, "");
             
                    var reg = new RegExp(arrayOfHTxt[v] + ".*", "i");
             
                    if (CurCont.match(reg) == null) {
             
                        tbl.rows[i].style.display = 'none';
             
                    }
             
                }
             
            }
        } 
    </script>
    <script>
        function show(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("lead").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","getcompany.php?q="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<?php include("includes/sidebar.php"); ?>

<!--sidebar end-->
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
            <div class="col-sm-12">
                <section class="panel"  style="min-width: 1024px;">
                    <header class="panel-heading">
                        Opportunities
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="btn-group">
                    <?php if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM' || $_SESSION['role'] == 'BRH'){ ?>
					<a href="newopportunity.php">
                        <button id="editable-sample_new" class="btn btn-primary">
                            Add New Opportunity <i class="fa fa-plus"></i>
                        </button>
                    </a>
                    <?php } ?>
					</div>
                    <br><br>
                    <div class="text-left">
                            <a href="#myModal" data-toggle="modal" class="btn btn-success">
                                Generate Quotation
                            </a>
					</div>
					<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Generate Quotation</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="get" action="quotationform.php">
                                            <div class="form-group">
                                                <label for="OpportunityNames">Select Opportunity Name for which Quotation is to be generated</label>
                                                <select class="form-control" id="OpportunityNames" name="oppid" required>
                                                    <?php
														$query = mysqli_query($connection, "SELECT * FROM opportunities");
														$rows = mysqli_num_rows($query);
														for($i = 0; $i < $rows ; $i++){
															$result = mysqli_fetch_array($query);
													?>
													<option value="<?php echo $result[0] ; ?>"><?php echo $result[1] ; ?></option>
                                                <?php } ?>
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label for="machineNos">Number of machines</label>
                                                <input type="number" class="form-control" id="machineNos" name="mnumber" placeholder="Enter the number of machines">
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Opportunity Name</th> 
                        <th>Company</th>
                        <th>Branch</th>
                        <th>Creation Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Closing Date</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <?php if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM' || $_SESSION['role'] == 'BRH'){ ?>
                        <th>Edit</th>
                        <th>Delete</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <thead>
                    <tr class="gradeX">
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <?php if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM' || $_SESSION['role'] == 'BRH'){ ?>
                        <td></td>
                        <td></td>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						$query = mysqli_query($connection, "SELECT * FROM opportunities");
						$rows = mysqli_num_rows($query);
						for($i=0 ; $i<$rows ; $i++){
							$result = mysqli_fetch_array($query);
                            $q2 = mysqli_query($connection, "SELECT companyname FROM companies WHERE companyid='$result[2]'");
                            $r2 = mysqli_fetch_array($q2);
					?>
                    <tr class="gradeX" id="<?php echo 'row'.$result[0]; ?>">
                        <td><?php echo $result[1]; ?></td>
                        <td><?php echo $r2[0]; ?></td>
                        <td><?php echo $result[4]; ?></td>
                        <td><?php echo $result[5]; ?></td>
                        <td><?php echo getnamebyid($result[7], $connection); ?></td>
                        <td><?php echo $result[8]; ?></td>
                        <td><?php echo $result[13]; ?></td>
                        <td hidden><?php echo $result[3]; ?></td>
                        <td hidden><?php echo $result[6]; ?></td>
                        <td hidden><?php echo $result[9]; ?></td>
                        <td hidden><?php echo $result[10]; ?></td>
                        <td hidden><?php echo $result[11]; ?></td>
                        <td hidden><?php echo $result[12]; ?></td>
                        <td hidden><?php echo $result[14]; ?></td>
                        <td hidden><?php echo $result[7]; ?></td>
                        <td hidden><?php echo $result[2]; ?></td>
                        <?php if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM' || $_SESSION['role'] == 'BRH'){ ?>
                        <td><a class="edit" href="#myModal-1" data-toggle="modal" id = "<?php echo $result[0]; ?>" onclick="populateForm(this.id)">Edit</a></td>
                        <td><a class="delete" href="opportunities.php?oid=<?php echo $result[0] ; ?>" onclick="return confirm('Delete Opportunity?')">Delete</a></td>
                        <?php } ?>
                    </tr>
					<?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Opportunity Name</th> 
                        <th>Company</th>
                        <th>Branch</th>
                        <th>Creation Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Closing Date</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <?php if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM' || $_SESSION['role'] == 'BRH'){ ?>
                        <th>Edit</th>
                        <th>Delete</th>
                        <?php } ?>
                    </tr>
                    </tfoot>
                    </table>
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Edit Opportunity</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal" method="post" role="form">
                                            <div class="form-group ">
                                        <label for="oppName" class="control-label col-lg-3">Opportunity Name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="oppName" type="text" name="oppName" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="contactCompany" onchange="show(this.value)" name="company" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM companies");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                        if($i == 0)
                                                            $req_company = $result[0];
                                                ?>
                                                    <option value="<?php echo $result[0] ; ?>"> <?php echo $result[1] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="OpportunityForm" class="control-label col-lg-3">Lead</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="lead" name="lead" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT datetime FROM leads WHERE customer='$req_company'");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Creation Date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" name="crdate" id="crdate" size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="suser" class="control-label col-lg-3">Sourced By</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="user" name="user" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM users");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result['userid'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="suser" class="control-label col-lg-3">Assigned To</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="assignedto" id="assignedto" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM users");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result['userid'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oppstatus" class="control-label col-lg-3">Status</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="Initial">Initial</option>
                                                <option value="Quoted">Quoted</option>
                                                <option value="Negotiation">Negotiation</option>
                                                <option value="Order Received">Order Received</option>
                                                <option value="Order Lost">Order Lost</option>
                                                <option value="Dead">Dead</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oppstage" class="control-label col-lg-3">Stage</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="stage" name="stage" required>
                                                <option value="Hot">Hot</option>
                                                <option value="Warm">Warm</option>
                                                <option value="Cold">Cold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lsource" class="control-label col-lg-3">Source</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="source"  id="source" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT value FROM sources");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result[0] ; ?>"> <?php echo $result[0] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="amt" class="control-label col-lg-3">Total Amount</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="amount" type="number" name="amount" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="poi" class="control-label col-lg-3">Product of Interest</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="interest" name="interest" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM machines");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0 ;$i <$rows ; $i++){
                                                      $result = mysqli_fetch_array($query);
                                                  ?>
                                                    <option value="<?php echo $result[1]; ?>"><?php echo $result[1]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Approx. Closing date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" id="cdate" name="cdate"  size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oremarks" class="control-label col-lg-3">Remarks</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="oremarks" name="oremarks"></textarea>
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-control" id="oppid" type="hidden" name="oppid" />
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

<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<script src="js/bootstrap-switch.js"></script>

<script type="text/javascript" src="js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>
<script src="js/toggle-init.js"></script>

<script src="js/advanced-form.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>