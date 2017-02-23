<?php
require_once("config.php");
require_once("includes/icase_functions.php");

if(isset($_GET['id']) && $_GET['t'] == "ipo" && $_GET['a'] == "edit") {
    $field = $_GET['id'];
    
    $query = "SELECT * FROM tbl_ipos WHERE ipo_id='$field'";
    $result = mysqli_query($conn, $query) or die(mysqli_connect_error());
    
    $ipo = mysqli_fetch_assoc($result);
}
    
    if(isset($_POST['updateBtn'])) {
        $ipoid = $_POST['ipo_id'];
        $name = $_POST['ipo_name'];
        $gender = $_POST['gender'];
        $rank = $_POST['rank'];
        $team = $_POST['team'];
        $gsm = $_POST['phone'];
        $head = $_POST['head'];
        $visible = $_POST['visible'];
        $station = $_POST['station'];
        $state = $_POST['state'];
        $dept = $_POST['dept'];
        $email = $_POST['email'];
        $ipodp = $_POST['ipo_dp'];
        $ipo_org_id = $_POST['ipo_org_id'];
		

        $pic = ($_FILES['photo']['name'] != "") ? $_FILES['photo']['name'] : "0";
        $photo = ($pic == "0") ? $ipodp : date('ymd').time().$pic;


        $update_query = "UPDATE tbl_ipos SET ipo_name='$name', ipo_rank='$rank', ipo_team='$team', ipo_gsm='$gsm', ipo_photo='$photo', ipo_is_team_head='$head', ipo_gender='$gender', visible='$visible', ipo_station='$station', ipo_email='$email', ipo_state='$state', ipo_dept='$dept', ipo_org_id='$ipo_org_id' WHERE ipo_id='$ipoid'";
        $update_result = mysqli_query($conn, $update_query) or die(mysqli_connect_error());
        //die($update_query);

        if($update_result) {
            if($pic != "0") {
                copy($_FILES['photo']['tmp_name'], "uploads/ipos/".$photo);
            }
            
            header("Location: ipo.php?a=edit&t=ipo&s=1");
        } else {
            header("Location: ipo.php?a=edit&t=ipo&s=0");
        }
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : IPOs</title>
	<?php include("includes/head.phtml"); ?>
</head>
<body>
    <div id="wrapper">
        <?php include("includes/header.phtml"); ?> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>IPO Registration</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Edit/Update Record
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                    <div class="row">
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<label for="ipo_id" class="col-sm-12">IPO ID</label>
														<div class="col-sm-12">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-key"></i></span>
																<input type="hidden" name="ipo_id" value="<?php echo $ipo['ipo_id']; ?>">
																<input type="text" value="<?php echo $ipo['ipo_id']; ?>" class="form-control" readonly required />
															</div>
														</div>
													</div>
												</div> <!-- end of col-sm-9 -->
												<div class="col-sm-8">
													<div class="form-group">
														<label for="ipo_name" class="col-sm-12">Name</label>
														<div class="col-sm-12">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-user"></i></span>
																<input type="text" value="<?php echo $ipo['ipo_name']; ?>" name="ipo_name" class="form-control" required />
															</div>
														</div>
													</div>
												</div> <!-- end of col-sm-12 -->
											</div>
											<!-- ********** -->
											<div class="row">
												<div class="col-sm-3">
													<div class="form-group">
														<label for="gender" class="col-sm-12">Gender</label>
														<div class="col-sm-12">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-users"></i></span>
																<select name="gender" class="form-control">
																	<option value="Male" <?php if($ipo['ipo_gender'] == "Male") { echo "selected"; } ?>>Male</option>
																	<option value="Female" <?php if($ipo['ipo_gender'] == "Female") { echo "selected"; } ?>>Female</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label for="phone" class="col-sm-12">Phone Number</label>
														<div class="col-sm-12">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-phone"></i></span>
																<input type="text" value="<?php echo $ipo['ipo_gsm']; ?>" name="phone" class="form-control" />
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<label for="email" class="col-sm-12">E-mail</label>
														<div class="col-sm-12">
															<div class="input-group">
																<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
																<input type="text" value="<?php echo $ipo['ipo_email']; ?>" name="email" class="form-control" required />
															</div>
														</div>
													</div>
												</div>
											</div>
									<!--		<div class="row">
												<div class="col-sm-9">

												</div> 
												<div class="col-sm-3">
													<div class="">&nbsp;</div>
												</div>
											</div>
											 ********** 
											<div class="row">
												<div class="col-sm-9">
												
												</div> 
												<div class="col-sm-3">
													<div class="">&nbsp;</div>
												</div>
											</div>
											-->
										</div>
                                        <div class="col-sm-3">
                                            <div class="img-rounded">
                                                <img src="uploads/ipos/<?php echo $ipo['ipo_photo']; ?>" class="img-responsive">
                                            </div>
                                            <input type="hidden" name="ipo_dp" value="<?php echo $ipo['ipo_photo']; ?>">
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
									<hr/>
											<!-- ********** -->
											<div class="row">
												<div class="col-sm-3">
											<!--	<div class="col-sm-12" style="background-color:#555;"> -->
													<h3>Official Record</h3>
												</div> <!-- end of col-sm-9 -->
											</div>
									
									<!-- ********** -->
									<div class="row">
										<div class="col-sm-8">
											<div class="form-group">
												<label for="org_id" class="col-sm-12">Organisation</label>
												<div class="col-sm-12">
                                                    <select id="orgid" name="ipo_org_id" class="form-control">
                                                        <option>-- Select Organization --</option>
                                                        <?php $lst_orgs = get_orgs(); $org_count = mysqli_num_rows($lst_orgs); if($org_count !== 0) { 
                                                        while($row = mysqli_fetch_assoc($lst_orgs)) { ?>
                                                        <option value="<?php echo $row['org_id']; ?>" data-org="<?php echo $row['org_name']; ?>"><?php echo $row['org_name']; ?></option>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </select>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for="state" class="col-sm-12">State</label>
												<div class="col-sm-12">
                                                    <select name="state" id="statedd" class="form-control">
                                                        <option>-- Select State --</option>
                                                        <?php $lst_states = get_states(); $lst_count = mysqli_num_rows($lst_states); ?>
                                                        <?php if($lst_count !== 0) { while($state = mysqli_fetch_assoc($lst_states)) { ?>
                                                        <option value="<?php echo $state['state']; ?>" <?php if($state['state'] == $ipo['ipo_state']) { echo "selected"; } ?>><?php echo $state['state']; ?></option>
                                                        <?php } } ?>
                                                    </select>
												</div>
											</div>
										</div>
									</div>
									<!-- ********** -->
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                        </div>
                                        
                                        <div class="col-sm-8">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="rank" class="col-sm-12">Rank</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-"></i></span>
                                                        <input type="text" value="<?php echo $ipo['ipo_rank']; ?>" name="rank" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="dept" class="col-sm-12">Department</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-"></i></span>
                                                        <input type="text" value="<?php echo $ipo['ipo_dept']; ?>" name="dept" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="station" class="col-sm-12">Station</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-"></i></span>
                                                        <input type="text" value="<?php echo $ipo['ipo_station']; ?>" name="station" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="head" class="col-sm-12">Is IPO Head</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-"></i></span>
                                                        <select name="head" class="form-control">
                                                            <option value="1" <?php if($ipo['ipo_is_team_head'] == "1") { echo "selected"; } ?>>Yes</option>
                                                            <option value="0" <?php if($ipo['ipo_is_team_head'] == "0") { echo "selected"; } ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="visible" class="col-sm-12">Visible</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-"></i></span>
                                                        <select name="visible" class="form-control">
                                                            <option value="1" <?php if($ipo['ipo_gender'] == "1") { echo "selected"; } ?>>Yes</option>
                                                            <option value="0" <?php if($ipo['ipo_gender'] == "0") { echo "selected"; } ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="team" class="col-sm-12">Team</label>
                                                <div class="col-sm-12">
                                                    <select name="team" id="ipoTeam" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="panel-footer">
                                <div class="form-group text-right">
                                    <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                    <button type="submit" class="btn btn-success" name="updateBtn">Save</button>
                                </div>
                            </div>
                            </form>
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
    <script type="text/javascript">
        
        function getstid(val){
            //alert (val);
            $.ajax({
                type: "POST",
                url: "get_lgas.php",
                data: "cid="+val,
                success: function(data){
                    $("#lgadd").html(data);
                }
            });
        }
         function getorgid(val){
            //alert (val);
            $.ajax({
                type: "POST",
                url: "orgs_teams_ajax.php",
                data: "cid="+val,
                success: function(data){
                    $("#teamdd").html(data);
                }
            });
        }
        
    </script>
   
   
</body>
</html>
