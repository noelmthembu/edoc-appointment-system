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
        
    <title>Sign Up</title>
    
</head>
<body>
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



if($_POST){

    

    $_SESSION["personal"]=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'address'=>$_POST['address'],
        'nic'=>$_POST['nic'],
        'dob'=>$_POST['dob']
    );


    print_r($_SESSION["personal"]);
    header("location: create-account.php");




}

?>
<?php include_once('header.php');?>

<body class="simple-page">

<div class="simple-page-wrap">
    <div class="simple-page-form animated flipInY" id="login-form">
    <p class="header-text text-center">Let's Get Started</p>
        <h4 class="form-title m-b-xl text-center">Add Your Personal Details to Continue</h4>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="fname" placeholder="First Name" required="true">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="lname" placeholder="Last Name" required="true">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Address" required="true">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="nic" placeholder="NIC" required="true">
            </div>

            <div class="form-group">
                <input type="date" name="dob" value="" class="form-control" required="true">
            </div>
            <!--<input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >-->
            <input type="submit" class="btn btn-primary" value="Next">
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
</body>
</html>