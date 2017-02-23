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
                <div class="row">
                    <div class="col-md-9">
                  <!--   <i class="fa fa-conectdevelop fa-3x"></i><h2>iCase</h2>   --> 
                    <h2><b>iCase</b></h2>   
                        <h5>
							Welcome!<br>
							This is an integrated Case Management System. It tracks Cases ...
						</h5>
                    </div>
                    <div class="col-md-3" style="background-color:white;">
                     <h4><b>Petition (Direct)</b></h4>   
                    <!-- <i class="fa fa-skyatlas fa-3x"></i><h2>iCase</h2> -->  
                         <a class="btn btn-success" href="#"><i class="fa fa-folder-open-o fa-2x"></i><b> Register New Petition</b></a>
                       <h5></h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                
            <h2><b>Police</b></h2>   
			<div class="row">
                <div class="col-md-6">
                    <div class="row">
                        
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-grey set-icon">
                                    <i class="fa fa-folder-open-o"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">Case Diary</p>
                                    <p class="text-muted">Details of casefiles</p>
                                </div>
                            </div>
                         </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-grey set-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text">Suspects</p>
                                <p class="text-muted">Profile of Suspects</p>
                            </div>
                         </div>
                         </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-6">           
				<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-grey set-icon">
                    <i class="fa fa-pied-piper-alt"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Arrests</p>
                    <p class="text-muted">Tracks of Arrests</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-user"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">IPOs</p>
                    <p class="text-muted">Profile of IPOs</p>
                </div>
             </div>
		     </div>
                        
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div id="chart-container">
                        <canvas id="clients" width="500" height="350"></canvas>
                        <small>Summary of Cases</a></small>
                        <!-- <canvas id="mycanvas"></canvas> -->
                    </div>
                </div>
                       
			</div>
			
       <!-- <hr /> -->   
               <h2><b>Legal</b></h2>   
			<div class="row" style="background-color:cyan;padding:6px;">
               <br /><div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
					<span class="icon-box bg-color-red set-icon">
						<i class="fa fa-mortar-board"></i>
					</span>
					<div class="text-box" >
						<p class="main-text">Counsels</p>
						<p class="text-muted">Profile and activites of Counsels</p>
					</div>
				</div>
		     </div>
		    <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
					<span class="icon-box bg-color-red set-icon">
						<i class="fa fa-file-text-o"></i>
					</span>
					<div class="text-box" >
						<p class="main-text">MOJ Entries</p>
						<p class="text-muted">Case Register in MOJ</p>
					</div>
				 </div>
		     </div>
			 
             <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-gear"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Case Progress</p>
                    <p class="text-muted">Case Progress..</p>
                </div>
				</div>
		     </div>
		     </div>
       <!-- <hr /> -->   
            <h2><b>Court</b></h2>   
 			<div class="row" style="background-color:magenta;padding:6px;">
              <br/> <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
					<span class="icon-box bg-color-brown set-icon">
						<i class="fa fa-user"></i>
					</span>
					<div class="text-box" >
						<p class="main-text">Courts Info</p>
						<p class="text-muted">Addresses of Courts</p>
					</div>
				</div>
		     </div>
		    <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
					<span class="icon-box bg-color-brown set-icon">
						<i class="fa fa-user"></i>
					</span>
					<div class="text-box" >
						<p class="main-text">Profile of Judges</p>
						<p class="text-muted">Profile of Judges</p>
					</div>
				 </div>
		     </div>
			 
             <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-user"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Court Case</p>
                    <p class="text-muted">Casefles, Hearings, etc.</p>
                </div>
             </div>
		     </div>

			</div>
       <!-- <hr /> -->   
            <h2><b>Prisons</b></h2>   
 			<div class="row" style="background-color:magenta;padding:6px;">
              <br/> <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
					<span class="icon-box bg-color-brown set-icon">
						<i class="fa fa-user"></i>
					</span>
					<div class="text-box" >
						<p class="main-text">Profile of ATPs</p>
						<p class="text-muted">Records of ATPs</p>
					</div>
				</div>
		     </div>
		    <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
					<span class="icon-box bg-color-brown set-icon">
						<i class="fa fa-user"></i>
					</span>
					<div class="text-box" >
						<p class="main-text">Admission Records</p>
						<p class="text-muted">Detention Database</p>
					</div>
				 </div>
		     </div>
			 
             <div class="col-md-4 col-sm-4 col-xs-4">           
				<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-user"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Discharge Records</p>
                    <p class="text-muted">Details of Releases</p>
                </div>
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
