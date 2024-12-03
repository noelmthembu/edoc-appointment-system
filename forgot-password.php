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
    <title>Forgot Password</title>

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

if(isset($_POST['submit']))
  {
$email=$_POST['email'];
$mobile=$_POST['patname'];
$newpassword=md5($_POST['newpassword']);

$sql ="SELECT pemail FROM patient WHERE pemail=email and pname=patname";

$query= $dbh -> prepare($sql);
$query-> bindParam('email', $email, PDO::PARAM_STR);
$query-> bindParam('patname', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update patient set ppassword=newpassword where pemail=email and pname=patname";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam('email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam('patname', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam('newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
<?php include_once('header.php');?>

<div class="simple-page-wrap">
    <div class="simple-page-form animated flipInY" id="login-form">
    <p class="header-text text-center">Reset Your Password</p>
        <h4 class="form-title m-b-xl text-center">It's Okay, Let's Reset.</h4>

        <form action="" method="POST" name="chngpwd">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Email Address" required="true" name="email">
		</div>

		<div class="form-group">
			<input type="text" class="form-control"  name="patname" placeholder="Patient Name" required="true">
		</div>

		<div class="form-group">
            <input class="form-control" type="password" name="newpassword" placeholder="New Password" required="true"/>
        </div>

        <div class="form-group">
            <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" required="true" />
        </div>

		<input type="submit" class="btn btn-primary" name="submit" value="RESET">

        </form>

        <hr />
        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
    </div><!-- #login-form -->

    <div class="simple-page-footer">
        <p><a href="forgot-password.php">FORGOT YOUR PASSWORD ?</a></p>
    </div><!-- .simple-page-footer -->

</div>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</body>
</html>