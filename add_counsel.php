<?php
require_once("config.php");
require_once("includes/icase_functions.php");

if(isset($_POST['saveBtn'])) {
   // $counsel_id = $_POST['counsel_id'];
    $moj_id = $_POST['moj_id'];
    $cnsl_name = $_POST['cnsl_name'];
    $enrolmentno = $_POST['enrolmentno'];
    $date_enrol = $_POST['date_enrol'];
    $cnsl_dept = $_POST['cnsl_dept'];
    $cnsl_rank = $_POST['cnsl_rank'];
    $cnsl_dob = $_POST['cnsl_dob'];
    $cnsl_gender = $_POST['cnsl_gender'];
    $cnsl_addr = $_POST['cnsl_addr'];
    $cnsl_phone = $_POST['cnsl_phone'];
    $cnsl_email = $_POST['cnsl_email'];
    $cnsl_remark = $_POST['cnsl_remark'];
    $visible = $_POST['visible'];
    
    $pic = $_FILES['cnsl_photo']['name'];
    $cnsl_photo = date('ymd').time().$pic;
    
    
    $create_query = "INSERT INTO tbl_counsels (moj_id, cnsl_name, enrolmentno, date_enrol, cnsl_dept, cnsl_rank, cnsl_dob, cnsl_gender, cnsl_addr, cnsl_phone, cnsl_email, cnsl_remark, cnsl_photo, visible ) VALUES ('$moj_id', '$cnsl_name', '$enrolmentno', '$date_enrol', '$cnsl_dept', '$cnsl_rank', '$cnsl_dob', '$cnsl_gender', '$cnsl_addr', '$cnsl_phone', '$cnsl_email', '$cnsl_remark', '$cnsl_photo', '$visible')";
    
    $create_result = mysqli_query($conn, $create_query);
   // $create_result = mysqli_query($conn, $create_query) or die(mysqli_connect_error());
   
    if($create_result) {
        copy($_FILES['cnsl_photo']['tmp_name'], "uploads/counsels/".$cnsl_photo);
        header("Location: counsel_details.php?counsel_id={$_get['counsel_id']}&a=create&t=counsel&s=1");
     //    echo "Successful";
   } else {
    //    echo "Not Successful";
        header("Location: counsels.php?a=create&t=ipo&s=0");
    }
    //die();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Counsel Documentation</title>
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
                     <h2>Counsels</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Add Counsel
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <!--                                   
                                    <div class="form-group">
                                        <label for="counsel_id" class="col-sm-12">Counsel ID</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" placeholder="IPO ID Number" name="counsel_id" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
-->                                    
                                    <div class="form-group">
                                            <label for="moj_id" class="control-label col-sm-12">Ministry</label>
                                            <div class="col-md-6" id="moj">
                                                <?php 
                                                    $lst_mojs = get_mojs();
                                                    $moj_count = mysqli_num_rows($lst_mojs);
                                                    if ($moj_count>0){
                                                        
                                                    // Display Listbox
                                                    
                                                    //   echo "<select id=\"mojdd\" name='moj_id' class=\"form-control selectpicker\" Required onchange=\"getstid(this.value); \">";
                                                            
                                                        echo "<select id=\"mojdd\" name='moj_id' class=\"form-control selectpicker\" Required>";
                                                        echo '<option value="">Select Ministry</option>';
                                                        while ($row = $lst_mojs->fetch_assoc()) 
                                                        {
                                                          unset($id, $name);
                                                          $name = $row['moj_name']; 
                                                          $id = $row['moj_id'];
                                                          //echo '<option value="'.$id.'">'.$name.'</option>';
                                                          echo '<option value="'.$moj_id.'">'.$name.'</option>';
                                                        }
                                                        echo "</select>";
                                                        
                                                    } else {
                                                        // use Textbox instead
                                                        ?>
                                                        <input type="text" placeholder="Ministry of Justice" name="moj_id" class="form-control" required />
                                                <?php
                                                     }
                                                ?>
                                            </div>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="cnsl_name" class="col-sm-12">Name</label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" placeholder="Counsel Name" name="cnsl_name" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="row">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                            <label for="enrolmentno" class="col-sm-12">Enrolment No</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" placeholder="Enrolment Number" name="enrolmentno" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="date_enrol" class="col-sm-12">Date Enrolled</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" placeholder="Date Enrolled" name="date_enrol" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                     <div class="col-sm-6">
                                       <div class="form-group">
                                            <label for="cnsl_dept" class="col-sm-12">Department</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" placeholder="Department" name="cnsl_dept" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cnsl_dept" class="col-sm-12">Rank</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" placeholder="Rank" name="cnsl_rank" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cnsl_dob" class="col-sm-12">Date of Birth</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input type="text" placeholder="Date of Birth" name="cnsl_dob" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
            
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cnsl_gender" class="col-sm-12">Gender</label>
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                    <select name="cnsl_gender" class="form-control">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="cnsl_remark" class="col-sm-12">Remark</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="cnsl_remark" rows="4" placeholder="Remark"></textarea>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="cnsl_email" class="col-sm-12">E-mail</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                                        <input type="text" placeholder="E-mail" name="cnsl_email" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="cnsl_phone" class="col-sm-12">phone Number</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                        <input type="text" placeholder="Phone Number" name="cnsl_phone" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                    
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label for="cnsl_photo" class="control-label sr-only">cnsl_photo</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
                                                    <input type="file" name="cnsl_photo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="cnsl_addr" class="col-sm-12">Contact Address</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="cnsl_addr" rows="4" placeholder="Contact Address"></textarea>
                                        </div>
                                    </div>
                                </div>

                                    
                                <div class="row">
                                   <div class="col-sm-4">
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
