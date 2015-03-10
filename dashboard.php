<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>
<?php include("includes/toggle.php"); ?>

</section>
<!--Main panel starts -->
<div class="maincontent">
    <div class="date-info">
        Date: 1/1/2001<br>
    </div>
    <div class="content-window">
        <div class="information" style="margin-top:10px; text-align:left">
            <div>
                Mode:           asdjflasd <br>
                For:            asdfjl <br>
                Customer:       asdjflasd <br>
                Oppt. Name:     asdfjl <br>
                By:             asdjflasd <br>
                Notes:          asdfjl <br>
                Branch:         asdjflasd  
                Next follow-up: asdfjl
            </div>
            <div class="li-class1" style="margin-top:39px"><a href="#" class="btn" style="margin-top:-46px">Edit</a></div>
            <div class="li-class2"><a href="#" class="btn" style="background-color:#2a33de; margin-top:-46px">Follow-up</a></div>
            <div class="li-class3"><a href="#" class="btn" style="background-color:#1ab82c; margin-top:-46px">History</a></div>
        </div>

   </div>
   <div class="content-window">
   </div>
   <div class="content-window">
   </div>
</div>

<!-- Main panel ends -->

<?php include("includes/footer.php"); ?>