<?php
require_once("config.php");
require_once("includes/icase_functions.php");

$field = $_REQUEST['id'];

$fetch_query = "SELECT fileloc, fileloc_modl, fileloc_date FROM tbl_casediary WHERE crno='$field' LIMIT 1";
    $fetch_result = mysqli_query($conn, $fetch_query) or die(mysqli_connect_error());

    $loadcase = mysqli_fetch_assoc($fetch_result);
$fileloc = $loadcase['fileloc'];

$get_org = get_modl($loadcase['fileloc_modl'], $fileloc);

?>
                                
<div class="form-group">
    <label class="control-label col-sm-4">File Location</label>
    <div class="col-sm-7">
        <?php echo $get_org['name']; ?>, <?php echo $get_org['state']; ?>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-4">Date Sent</label>
    <div class="col-sm-7">
        <?php echo $loadcase['fileloc_date']; ?>
    </div>
</div>