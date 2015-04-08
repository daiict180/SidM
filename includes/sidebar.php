<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="dashboard.php" class="logo">
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
        
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="<?php echo "images/".$_SESSION['user'].".jpg"; ?>">
                <span class="username"><?php echo getnamebyid($_SESSION['user'], $connection) ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="profile.php"><i class="fa fa-suitcase"></i>Profile</a></li>
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
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo "class='active'"; ?> href="dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "companies.php") echo "class='active'"; ?> href="companies.php">
                        <i class="fa fa-university"></i>
                        <span>Companies</span>
                    </a>
                </li>
                <li>
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "companycontacts.php") echo "class='active'"; ?> href="companycontacts.php">
                        <i class="fa fa-info"></i>
                        <span>Company Contacts</span>
                    </a>
                </li>
                <li>
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "setupinfo.php") echo "class='active'"; ?> href="setupinfo.php">
                        <i class="fa fa-cog"></i>
                        <span>Setup Information</span>
                    </a>
                </li>
                <li>
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "leads.php") echo "class='active'"; ?> href="leads.php">
                        <i class="fa fa-magnet"></i>
                        <span>Leads</span>
                    </a>
                </li>
                <li>
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "opportunities.php") echo "class='active'"; ?> href="opportunities.php">
                        <i class="fa fa-level-up"></i>
                        <span>Opportunities</span>
                    </a>
                </li>
                <li>
                    <a <?php if(basename($_SERVER['PHP_SELF']) == "calls.php") echo "class='active'"; ?> href="calls.php">
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
                        <li><a href="leadsreports.php">Leads</a></li>
                        <li><a href="openopportunityreports.php">Opportunities</a></li>
                        <li><a href="live-vs-dead-reports.php">Live/Dead Leads</a></li>
                        <?php if($_SESSION['role'] != 'SAE'){ ?>
                        <li><a href="branchwisecharts.php">Opportunities Vs. Leads</a></li>
                        <li><a href="machinewisereport.php">Machinewise Sales</a></li>
                        <?php } ?>
                        <li><a href="salesreport.php">Sales Report</a></li>
                        <?php if($_SESSION['role'] != 'SAE'){ ?>
                        <li><a href="forecastchart.php">Forecast/Exception Report</a></li>
                        <?php } ?>
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
                        <li><a href="documentsmaster.php">Document Types</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Utilities</span>
                    </a>
                    <ul class="sub">
                        <li><a href="maps.php">Nearby Clients</a></li>
                        <li><a href="clientroutes.php">Routes</a></li>
                        <li><a href="filemanager.php">Document Manager</a></li>
                        <li><a href="composeemail.php">Transanctional Email</a></li>
                        <li><a href="https://login.mailchimp.com/" target="_blank">Group Email</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
