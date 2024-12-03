<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/nav-style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/core.css">
	<link rel="stylesheet" href="css/misc-pages.css">
        
    <title>Create Account</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body class="simple-page">
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");





if($_POST){

    $result= $database->query("select * from webuser");

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['personal']['address'];
    $nic=$_SESSION['personal']['nic'];
    $dob=$_SESSION['personal']['dob'];
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    
    if ($newpassword==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            
            $database->query("insert into patient(pemail,pname,ppassword, paddress, pnic,pdob,ptel) values('$email','$name','$newpassword','$address','$nic','$dob','$tele');");
            $database->query("insert into webuser values('$email','p')");

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: patient/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }



    
}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>
<?php include_once('header.php');?>

<div class="simple-page-wrap">
    <div class="simple-page-form animated flipInY" id="login-form">
    <p class="header-text text-center">Let's Get Started</p>
        <h4 class="form-title m-b-xl text-center">It's Okey, Now Create User Account.</h4>

        <form action="" method="POST">
            <div class="form-group">
                <input type="email" class="form-control"  name="newemail" placeholder="Enter Email" required="true">
            </div>

            <div class="form-group">
                <input type="tel" class="form-control" name="tele" placeholder="Cell Phone" pattern="[0]{1}[0-9]{9}" required="true">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="newpassword" placeholder="New Password" required="true">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="cpassword" placeholder="Conform Password" required="true">
            </div>

            <div class="">
            <?php echo $error ?>
            </div>

            <input type="submit" class="btn btn-primary" value="Sign Up">
        </form>

        <hr />
        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
    </div><!-- #login-form -->

    <div class="simple-page-footer">
        <p><a href="forgot-password.php">FORGOT YOUR PASSWORD ?</a></p>
    </div><!-- .simple-page-footer -->

</div>
</body>
</html>