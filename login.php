<?php
//Login Block
include("config.php");
if(isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM tbl_members WHERE username='$username' AND password='$password'";

    $login_query_result = mysqli_query($link, $login_query) or die(mysqli_connect_error());

    $user = mysqli_fetch_assoc($login_query_result);

    $returned = mysqli_num_rows($login_query_result);

    if($returned != 0) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['name'] = $user['fullname'];
        $_SESSION['userid'] = $user['user_id'];
        $_SESSION['groupid'] = $user['usergroup_id'];


        if(isset($_SESSION['username'])) {
            if($_SESSION['account_type'] != "1") {
                header("Location: home.php");
            } else if($_SESSION['account_type'] == "1") {
                header("Location: index.php");
            }
        }
    } else {
        header("Location: login.php?a=login&s=failed");
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iCase : User Login</title>
	<?php include("includes/head.phtml"); ?>

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2>Login Prompt</h2>
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong> Enter login details </strong>
                            </div>
                            <div class="panel-body">
                                <form role="form">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                        <input type="text" class="form-control" placeholder="Your Username " name="username" />
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                        <input type="password" class="form-control"  placeholder="Your Password" name="password" />
                                    </div>
                                    <div class="form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" /> Remember me
                                        </label>
                                        <span class="pull-right">
                                            <a href="#" >Forget password ? </a> 
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-block btn-success" type="submit" name="loginBtn">Login</button>
                                    </div>
                                    
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/scripts.phtml"); ?>
   
</body>
</html>
