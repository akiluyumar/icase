<?php
require_once("config.php");
require_once("includes/icase_functions.php");

$field = $_REQUEST['id'];

//Fetch Case Trails / Logs
$casetrails_query = mysqli_query($conn, "SELECT * FROM tbl_case_log WHERE crno='$field' ORDER BY time_date_sent DESC LIMIT 5");
$casetrail_count = mysqli_num_rows($casetrails_query);

?>
<div class="table-responsive">
<table class="table table-striped">
    <tbody>
        <?php $i=0; while($casetrail = mysqli_fetch_assoc($casetrails_query)) { $i=$i+1; ?>
        <tr <?php if(fmod($i,2)==0){echo " bgcolor=\"#E8E7E6\" !important";} ?>>
            <td>
                <p>
                    <strong class="text-success">
                        <?php
                            $from = get_modl($casetrail['sent_from_modl'], $casetrail['from_modl_id']);
                            echo $from['name'];
                        ?> 
                        <span class="text-danger">to </span> 
                        <?php
                            $to = get_modl($casetrail['sent_from_modl'], $casetrail['from_modl_id']);
                            echo $to['name'];
                        ?>
                    </strong>
                    <small class="help-block pull-right">Date: <?php echo $casetrail['time_date_sent']; ?></small><br />
                    <?php echo $casetrail['sent_message']; ?>
                </p>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>