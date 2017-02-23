<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase: Case Management Portal</title>
    <?php include("includes/head.phtml"); ?>
    
    <style type="text/css">
        #chart-container {
            width: 640px;
            height: auto;
        }
        small{
            display: block;
            margin-top: 1em;
        }
    </style>
    
</head>
<body>
    <div id="wrapper">   
           <!-- /. NAV TOP  -->
        <?php include("includes/header.phtml"); ?> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <h2><b>Dashboard</b></h2>   
			<div class="row">
                <?php include("includes/dashboard-police.php"); ?>
            </div>
			<div class="row">
                <?php include("includes/dashboard-ministry.php"); ?>
            </div>
			<div class="row">
                <?php include("includes/dashboard-courts.php"); ?>
            </div>
			<div class="row">
                <?php include("includes/dashboard-prisons.php"); ?>
            </div>
                <!-- /. ROW  -->
                  <hr />
            <h2><b>Police</b></h2>   
			<div class="row">
            
                <div class="col-md-6">
                    <div id="chart-container">
                        <canvas id="clients" width="250" height="200"></canvas>
                        <small>Cases by Offence Type</small>
                        <!-- <canvas id="mycanvas"></canvas> -->
                    </div>
                </div>
                       
                <div class="col-md-6">
                    <div id="chart-container2">
                        <canvas id="clients" width="250" height="200"></canvas>
                        <?php include ("includes/chart2.php"); ?>
                        <small>Cases by ..</small>
                        <!-- <canvas id="mycanvas"></canvas> -->
                    </div>
                </div>
                       
                        
			</div>
			
		
                 <!-- /. ROW  -->           
        </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
    </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/scripts.phtml"); ?>
   
</body>
</html>
