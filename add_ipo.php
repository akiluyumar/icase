<?php
require_once("config.php");
require_once("includes/icase_functions.php");

if(isset($_POST['saveBtn'])) {
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
    $ipo_org_id = $_POST['ipo_org_id'];
    
    $pic = $_FILES['photo']['name'];
    $photo = date('ymd').time().$pic;
    
    
    $create_query = "INSERT INTO tbl_ipos(ipo_id, ipo_name, ipo_rank, ipo_team, ipo_gsm, ipo_photo, ipo_is_team_head, ipo_gender, visible, ipo_station, ipo_email, ipo_state, ipo_dept, ipo_org_id) VALUES ('$ipoid', '$name', '$rank', '$team', '$gsm', '$photo', '$head', '$gender', '$visible', '$station', '$email', '$state', '$dept', '$ipo_org_id')";
    $create_result = mysqli_query($conn, $create_query) or die(mysqli_connect_error());
    
    if($create_result) {
        copy($_FILES['photo']['tmp_name'], "uploads/ipos/".$photo);
        header("Location: ipo.php?a=create&t=ipo&s=1");
    } else {
        header("Location: ipo.php?a=create&t=ipo&s=0");
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Case Diary</title>
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
                     <h2>IPOs</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Add New IPO
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                    <div class="form-group">
                                        <label for="ipo_id" class="col-sm-12">IPO ID</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" placeholder="IPO ID Number" name="ipo_id" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="ipo_name" class="col-sm-12">Names</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" placeholder="IPO Name" name="ipo_name" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="gender" class="col-sm-12">Gender</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                        <select name="gender" class="form-control">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="state" class="col-sm-12">State</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                        <select name="state" id="statedd" class="form-control">
                                                        <option>-- Select State --</option>
                                                        <?php $lst_states = get_states(); $lst_count = mysqli_num_rows($lst_states); ?>
                                                        <?php if($lst_count !== 0) { while($state = mysqli_fetch_assoc($lst_states)) { ?>
                                                        <option value="<?php echo $state['state']; ?>"><?php echo $state['state']; ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            
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
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="rank" class="col-sm-12">Rank</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-"></i></span>
                                                        <input type="text" placeholder="IPO Rank" name="rank" class="form-control" required />
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
                                                        <input type="text" placeholder="IPO Department" name="dept" class="form-control" />
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
                                                        <input type="text" placeholder="IPO Station" name="station" class="form-control" required />
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
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
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
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="photo" class="control-label sr-only">Photo</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="email" class="col-sm-12">E-mail</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                        <input type="text" placeholder="IPO E-mail" name="email" class="form-control" required />
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
                                                        <input type="text" placeholder="IPO Phone Number" name="phone" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="team" class="col-sm-12">Team</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                        <select name="team" id="ipoTeam" class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="panel-footer">
                                <div class="form-group text-right">
                                    <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                    <button type="submit" class="btn btn-success" name="saveBtn">Save</button>
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
    
   
</body>
</html>
