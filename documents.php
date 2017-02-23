<?php
require_once("config.php");

if(isset($_POST['uploadBtn'])) {
    $crno = $_POST['crno'];
    $doc_title = $_POST['doc_title'];
    $doc_location = $_FILES['doc_location']['name'];
    $doc = date('ymd').time().$doc_location;
    
    $create_query = "INSERT INTO tbl_case_docs(crno, doc_title, doc_location) VALUES ('$crno', '$doc_title', '$doc')";
    $create_result = mysqli_query($conn, $create_query) or die(mysqli_connect_error());
    
    if($create_result) {
        if(!empty($doc_location)) {
            copy($_FILES['doc_location']['tmp_name'], "uploads/docs/".$doc);
        }
        header("Location: casediary_details.php?ra=upload&rt=casedoc&rs=1&id={$crno}");
    } else {
        header("Location: documents.php?a=upload&t=casedoc&s=0");
    }
    
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : Documents</title>
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
                     <h2>Documents</h2>
                        <h5></h5>
                    </div>
                </div>
                
                <hr />
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>
                                    Upload Case Document
                                    <span class="pull-right">
                                        <a href="javascript:history.back(1)" onclick="return confirm('You are about to cancel this operation')" class="btn btn-primary">Cancel</a>
                                    </span>
                                </h3>
                            </div>
                            
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    
                                    <input type="hidden" name="crno" value="<?php echo $_GET['case']; ?>">
                                    <input type="hidden" name="suspid" value="<?php echo $_GET['susp']; ?>">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="doc_title">Title</label>
                                        <div class="col-md-4">
                                            <input type="text" name="doc_title" class="form-control" placeholder="Document Title">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="doc_location">Document</label>
                                        <div class="col-md-4">
                                            <input type="file" name="doc_location" />
                                        </div>
                                    </div>
                                    
                            </div>
                            
                            <div class="panel-footer">
                                <div class="form-group text-right">
                                    <a href="javascript:history.back(1)" class="btn btn-primary" onclick="return confirm('You are about to cancel this operation?')">Cancel</a>
                                    <button type="submit" class="btn btn-success" name="uploadBtn">Upload</button>
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
