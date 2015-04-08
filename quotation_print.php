<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>


<?php
if(!isset($_POST['submit'])){
    redirect_to("opportunities.php");
}

if(isset($_POST['qcompany']) && $_POST['mnumber']){
	$mnumber = $_POST['mnumber'];
	$company = $_POST['qcompany'];
	$date = $_POST['date'];
	$tax = $_POST['tax'];
	$dis = $_POST['discount'];
	for($i=1 ; $i<=$mnumber ; $i++){
		${'machine' . $i} = $_POST['machine'.$i];
		${'quantity' . $i} = $_POST['quantity'.$i];
		${'price' . $i} = $_POST['price'.$i];
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/invoice_print.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:21:29 GMT -->
<head>
    <a href="http://www.web2pdfconvert.com/convert">Save to PDF</a>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Quotation</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <link href="css/invoice-print.css" rel="stylesheet" media="all">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" class="print" >

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <section class="panel1">
                    <div class="panel-body invoice">
                        <div class="invoice-header">
                            <div class="invoice-title col-md-2 col-xs-2">
                            <br>
                            <br>
                                <img class="logo-print" src="images/logo1.png" alt="">
                            </div>
                            <div class="invoice-info col-md-8 col-xs-10">

                                <div class="pull-right">
                                    <div class="col-md-6 col-sm-6 pull-left">
                                        <p>B-105, Titanium City Center, <br>
                                            Prahalad Nagar Road,<br> Near IOC Petrol Pump, <br> 
                                            Ahmedabad 380015.</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 pull-right">
                                        <p>Phone: +91 78786 01515 <br>
                                            Email : kishorpareek@yahoo.com</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row invoice-to">
                            <div class="col-md-4 col-sm-4 pull-left">
                                <h4>Quotation To:</h4>
                                <h2><?php echo $company; ?></h2>
								<?php 
									$query = mysqli_query($connection, "SELECT * FROM companies WHERE companyname='$company'");
									$result = mysqli_fetch_array($query);
								?>
                                <p>
                                    <?php echo $result[3]; ?><br>
                                    <?php echo $result[4]; ?><br>
                                    Phone: <?php echo $result[14]; ?><br>
                                    Email : <?php echo $result[13]; ?>
                                </p>
                            </div>
                            <div class="col-md-4 col-sm-5 pull-right">
                                <!-- <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Invoice #</div>
                                    <div class="col-md-8 col-sm-7">233426</div>
                                </div>
                                <br> -->
								<?php
									$mm=substr($date, 0, 2);
									$dd=substr($date, 3, 2);
									$yy=substr($date, 6, 4);
								?>
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Date #</div>
                                    <div class="col-md-8 col-sm-7"><?php echo date("M jS, Y", strtotime($yy."-".$mm."-".$dd)); ?></div>
                                </div>
                                <!-- <br>
                                <div class="row">
                                    <div class="col-md-12 inv-label">
                                        <h3>TOTAL DUE</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <h1 class="amnt-value">$ 3120.00</h1>
                                    </div>
                                </div> -->


                            </div>
                        </div>
                        <table class="table table-invoice" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Description</th>
                                <th class="text-center">Unit Cost</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php
							$subtotal = 0;
							for($i = 1; $i <= $mnumber ; $i++){
							?>
                            <tr>
                                <td><?php echo $i ; ?></td>
                                <td>
                                    <h4><?php echo ${'machine' . $i} ; ?></h4>
									<?php
										$query = mysqli_query($connection, "SELECT description FROM machines WHERE machinename='${'machine' . $i}'");
										$result = mysqli_fetch_array($query);
									?>
                                    <p><?php echo $result[0]; ?></p>
                                </td>
                                <td class="text-center"><span class="WebRupee">&#x20B9;</span><?php echo ${'price' . $i} ; ?></td>
                                <td class="text-center"><?php echo ${'quantity' . $i} ; ?></td>
                                <td class="text-center"><span class="WebRupee">&#x20B9;</span><?php echo ${'price' . $i}*${'quantity' . $i} ; ?></td>
                            </tr>
							<?php 
							$subtotal = $subtotal + ${'price' . $i}*${'quantity' . $i} ;
							} 
							?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-8 col-xs-7 payment-method">
                                <!-- <h4>Payment Method</h4>
                                <p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <p>2. Pellentesque tincidunt pulvinar magna quis rhoncus.</p>
                                <p>3. Cras rhoncus risus vitae congue commodo.</p>
                                <br> -->
                                <h3 class="inv-label itatic">Thank you for your business</h3>
                            </div>
                            <div class="col-md-4 col-xs-5 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li>Sub - Total amount : <span class="WebRupee">&#x20B9;</span> <?php echo $subtotal; ?></li>
                                    <li>Discount : <?php echo $dis."%"; ?> </li>
                                    <li>TAX (<?php echo $tax."%"; ?>) ----- </li>
									<?php
									$grandtotal = $subtotal + (($subtotal*$tax)/100);
									$grandtotal = $grandtotal - (($grandtotal*$dis)/100);
									?>
                                    <li class="grand-total">Grand Total : <span class="WebRupee">&#x20B9;</span> <?php echo $grandtotal ; ?></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="js/jquery.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>


<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<script type="text/javascript">
    window.print();
</script>

</body>

<!-- Mirrored from bucketadmin.themebucket.net/invoice_print.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:21:30 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>