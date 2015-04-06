<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['readfile'])){
    $fileid = $_GET['readfile'];
    $query = mysqli_query($connection, "SELECT * FROM filemanager WHERE fileid = '$fileid'");
    $result = mysqli_fetch_array($query);

    $filename = $result['filename'];
    $filesize = $result['filesize'];
    $filetype = $result['filetype'];
    $filepath = $result['filepath'];

    header("Content-length: $filesize");
    header("Content-type: $filetype");
    header("Content-Disposition: attachment; filename=$filename");
    ob_clean();
    flush();
    readfile($filepath);
}

?>

<?php
$uploadDir = 'filemanager/';
if(isset($_GET['fid'])){
    $fid = $_GET['fid'];
    $query = mysqli_query($connection, "SELECT * FROM filemanager WHERE fileid='$fid'");
    $result = mysqli_fetch_array($query);
    $filename = $result['filename'];
    $filepath = $result['filepath'];


    chmod("filemanager/", 0600);


    if($filepath && unlink($filepath))
    $query = mysqli_query($connection, "Delete FROM filemanager WHERE fileid='$fid'");
}

?>

<?php

$uploadDir = 'filemanager/';

if(isset($_POST['submit'])){
    $fileName = $_FILES['inputFile']['name'];
    $tmpName = $_FILES['inputFile']['tmp_name'];
    $fileSize = $_FILES['inputFile']['size'];
    $fileType = $_FILES['inputFile']['type'];
    $specifiedtype = $_POST['doctype'];
    $uploadedby = getnamebyid($_SESSION['user'], $connection);

    $filePath = $uploadDir . $fileName;

    if ( !file_exists($uploadDir) ) {
      mkdir ($uploadDir, 0744);
    }

    $result = move_uploaded_file($tmpName, $filePath);
    if (!$result) {
        exit;
    }
    if(!get_magic_quotes_gpc())
    {
        $fileName = addslashes($fileName);
        $filePath = addslashes($filePath);
    }

    $query = "INSERT INTO filemanager VALUES ('','$fileName', '$fileType', '$fileSize', '$filePath', '$specifiedtype', '$uploadedby', NOW())";

    mysqli_query($connection, $query) or die('Error, query failed : ' . mysql_error());
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

    <title>FileManager</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--dynamic table-->
    <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <script type="text/javascript">
    </script>
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Upload Document
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="documentType">Document Type</label>
                                    <select id="documentType" name="doctype" class="form-control m-bot15">
                                    <?php
                                        $query = mysqli_query($connection, "SELECT * FROM documents");
                                        $rows = mysqli_num_rows($query);
                                        for($i=0; $i<$rows; $i++){
                                            $result = mysqli_fetch_array($query);
                                    ?>
                                        <option value="<?php echo $result[0]; ?>"><?php echo $result[1]; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputFile">Select File</label>
                                    <input required type="file" id="inputFile" name="inputFile">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                    
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start upload</span>
                                </button>    
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            <div class="col-sm-12">
                <section class="panel" style="min-width: 1024px;">
                    <header class="panel-heading">
                        Document Manager
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Document Type</th>
                        <th>Uploaded By</th>
                        <th>Upload Date/Time</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $query = mysqli_query($connection, "SELECT * FROM filemanager");
                            $rows = mysqli_num_rows($query);
                            for($i = 0 ; $i < $rows ; $i++){
                                $result = mysqli_fetch_array($query);
                                $q = mysqli_query($connection, "SELECT * FROM documents where doctypeid='$result[5]'");
                                $r = mysqli_fetch_array($q);
                        ?>
                    <tr class="gradeX" id = "row1">
                        <td><?php echo $result[1]; ?>
                        <div class="fa-hover col-md-3 col-sm-4"><a href="filemanager.php?readfile=<?php echo $result[0] ; ?>"><i class="fa fa-download"></a></div></td>
                        <td><?php echo $r[1]; ?></td>
                        <td><?php echo $result[6]; ?></td>
                        <td><?php echo $result[7]; ?></td>
                        <td><div class="fa-hover col-md-3 col-sm-4"><a href="filemanager.php?fid=<?php echo $result[0] ; ?>" onclick="return confirm('Delete File?')"><i class="fa fa-trash-o"></a></div></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Document Name</th>
                        <th>Document Type</th>
                        <th>Uploaded By</th>
                        <th>Upload Date/Time</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                    </table>
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
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>