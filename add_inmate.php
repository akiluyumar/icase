<?php
require_once("config.php");
require_once("includes/icase_functions.php"); 


if(isset($_GET['case'])) {
    $crno = $_GET['case'];
}

if(isset($_POST['addInmateBtn'])) {
    $case = $_POST['crno'];
    $susp_id = $_POST['susp_id'];
    $name = $_POST['name'];
    $gender= $_POST['gender'];
    $mstatus = $_POST['mstatus'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];
    $hometown = $_POST['hometown'];
    $lga = $_POST['lga'];
    $address = $_POST['address'];
    $photo = $_FILES['photo']['name'];
    $religion = $_POST['religion'];
    $prison_no = $_POST['prison_no'];
//    $prison_id = $_POST['prison_id'];
//    $date_reg = $_POST['date_reg'];
    $offence_cat_id = $_POST['offence_cat_id'];
    $offence_title = $_POST['offence_title'];
    $offence_details = $_POST['offence_details'];
    $date_committed = $_POST['date_committed'];
    $date_arraigned = $_POST['date_arraigned'];
    $date_2b_discharged = $_POST['date_2b_discharged'];
    $court_id = $_POST['court_id'];
    $status_id = $_POST['status_id'];
    $sentence = $_POST['sentence'];
    $sentence_begins = $_POST['sentence_begins'];
    $crime_location = $_POST['crime_location'];
    $crime_state = $_POST['crime_state'];
    $released = $_POST['released'];
    $releasedby = $_POST['releasedby'];
    $releaseddate = $_POST['releaseddate'];
    $visible = $_POST['visible'];
    
//    $added_by
//    $added_date
//    $date_reg = $_POST['date_reg'];

//  `fingerprint1` tinyblob,
//  `fingerprint2` tinyblob,

//    if(isset($photo)) {
//        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/suspects/".$_FILES['photo']['name']);
//    }
    
   $create_query = "INSERT INTO tbl_prisoner_file(crno, susp_id, name, sex, mstatus, dob, photo, religion, prison_no, prison_id, state, hometown, lga, address,    
   date_reg, offence_cat_id, offence_title, offence_details, date_committed, date_arraigned, date_2b_discharged, court_id, status_id, sentence, sentence_begins, crime_location, crime_state, released, releasedby, releaseddate, visible )        
   VALUES ('$case', '$susp_id', '$name', '$sex', '$mstatus', '$dob', '$photo', '$religion', '$prison_no', '$prison_id', '$state', '$hometown', '$lga', '$address',     
   '$date_reg', '$offence_cat_id', '$offence_title', '$offence_details', '$date_committed', '$date_arraigned', '$date_2b_discharged', '$court_id', '$status_id', '$sentence', '$sentence_begins', '$crime_location')";
    
    
    $create_result = mysqli_query($conn, $create_query) or die(mysqli_connect_error());
    
     
    if($create_result) {
        $suspect_id = mysqli_insert_id($conn);
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/suspects/".$photo);
        header("Location: arrest.php?ra=create&rt=suspect&s=1&a=arrest&case={$case}&susp={$suspect_id}");
    } else {
        header("Location: add_suspect.php?a=create&t=suspect&s=0");
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prisons : Inmates Documentation</title>
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
                     <h2>Inmate</h2>
                        <h5>Add New Inmate</h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>
                                        Inmate's Record
                                        <span class="pull-right">
                                            <a href="javascript:history.back(1);" onclick="return confirm('You are about to cancel this operation?');" role="button" class="btn btn-primary">Cancel</a>
                                        </span>
                                    </h3>
                                </div>

                                <div class="panel-body" style="background-color:#D4A190;">
                                    <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group">
                                            <label for="crno" class="control-label col-sm-3">Name of Inmate</label>
                                            <div class="col-sm-8">
                                                <input type="text" placeholder="Suspect Name" name="name" class="form-control" required />
                                            </div>
                                        </div>
                                        
                                        <!--    <input type="hidden" name="crno" value="<?php echo $crno; ?>"> -->
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Gender</label>
                                            <div class="col-md-3">
                                                <select name="gender" class="form-control">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Marital Status</label>
                                            <div class="col-md-5">
                                                <select name="mstatus" class="form-control">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widow">Widow</option>
                                                    <option value="Widower">Widower</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date of birth</label>
                                            <div class="col-md-5">
                                                <input type="date" name="dob" class="form-control" placeholder="Date of birth">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="state" class="control-label col-md-3">State of Origin</label>
                                            <div class="col-md-5" id="state">
                                                <?php 
                                                    $lst_states = get_states();
                                                    $st_count = mysqli_num_rows($lst_states);
                                                    if ($st_count>0){
                                                        // Display Listbox
                                                        echo "<select id=\"statedd\" name='state' class=\"form-control selectpicker\" Required onchange=\"getstid(this.value); \">";
                                                        echo '<option value="">Select State</option>';
                                                        while ($row = $lst_states->fetch_assoc()) 
                                                        {
                                                          unset($id, $name);
                                                          $name = $row['state']; 
                                                          //$id = $row['state'];
                                                          //echo '<option value="'.$id.'">'.$name.'</option>';
                                                          echo '<option value="'.$name.'">'.$name.'</option>';
                                                        }
                                                        echo "</select>";
                                                        
                                                    } else {
                                                        // use Textbox instead
                                                        ?>
                                                        <input type="text" placeholder="State of Origin" name="state" class="form-control" required />
                                                <?php
                                                     }
                                                ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="lga" class="control-label col-md-3">LGA</label>
                                            <div class="col-md-5" id='lga'>
                                            <select name="lga" id="lgadd" class="form-control">
                                            </option>
                                                 
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="hometown" class="control-label col-md-3">Home Town</label>
                                            <div class="col-md-8">
                                                <input type="text" placeholder="Home Town" name="hometown" class="form-control" required />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Address</label>
                                            <div class="col-md-9">
                                                <textarea rows="3" class="form-control" placeholder="Address" name="Address"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="religion" class="control-label col-md-3">Religion</label>
                                            <div class="col-md-8">
                                                <input type="text" name="religion" placeholder="Religion" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="Prison_no" class="control-label col-md-3">Prison No</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="prison_no" placeholder="Prison Number">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Offence Title</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Offence Title" name="offence_title">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Offence Category id</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="offence_cat_id" name="offence_cat_id">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Offence Details</label>
                                            <div class="col-md-9">
                                                <textarea rows="3" class="form-control" placeholder="Offence Details" name="offence_details"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date Committed</label>
                                            <div class="col-md-5">
                                                <input type="date" name="date_committed" class="form-control" placeholder="Date Offence was Committed">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date Arraigned</label>
                                            <div class="col-md-5">
                                                <input type="date" name="date_arraigned" class="form-control" placeholder="Date Arraigned">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date To Be Released</label>
                                            <div class="col-md-5">
                                                <input type="date" name="dob" class="form-control" placeholder="Date To Be Released">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Court</label>
                                            <div class="col-md-5">
                                                <input type="text" name="court_id" class="form-control" placeholder="Court">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Type of Detention</label>
                                            <div class="col-md-5">
                                                <input type="text" name="status_id" class="form-control" placeholder="Type of Detention">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Sentence</label>
                                            <div class="col-md-5">
                                                <input type="text" name="sentence" class="form-control" placeholder="Sentence">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Date Sentence Begins</label>
                                            <div class="col-md-5">
                                                <input type="text" name="sentence_begins" class="form-control" placeholder="Date Sentence Begins">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Crime Location</label>
                                            <div class="col-md-5">
                                                <input type="text" name="crime_location" class="form-control" placeholder="Crime Location">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Crime Location</label>
                                            <div class="col-md-5">
                                                <input type="text" name="crime_location" class="form-control" placeholder="Crime Location">
                                            </div>
                                        </div>

                                        
                                        <hr/>
                                        
                                        <div class="form-group">
                                            <label for="photo" class="control-label col-md-3">Photo</label>
                                            <div class="col-md-8">
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                        
                                        
                                </div>
                                </div>
                                
                                <div class="panel-footer">
                                    <div class="form-group text-right">
                                        <button type="submit" class="col-sm-offset-6 btn btn-success" name="addInmateBtn">Save Record</button>
                                    </div>
                                </div>
                                </form>
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
                url: "get_orgs.php",
                data: "cid="+val,
                success: function(data){
                    $("#lgadd").html(data);
                }
            });
        }

        
        
    </script>
   
</body>
</html>
