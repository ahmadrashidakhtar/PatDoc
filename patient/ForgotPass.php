<?php
session_start();
error_reporting(0);
include("..\include\config.php");
//Checking Details for reset password
if(isset($_POST['submit'])){
$name=$_POST['fullname'];
$email=$_POST['email'];
$query=mysqli_query($con,"select id from  patient_user where fullName='$name' and email='$email'");
$row=mysqli_num_rows($query);
if($row>0){

$_SESSION['name']=$name;
$_SESSION['email']=$email;
header('location:rest-password.php');
} else {
echo "<script>alert('Invalid details. Please try with valid details');</script>";
echo "<script>window.location.href ='ForgotPass.php'</script>";


}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <link rel="stylesheet" href="../vendor/css/Style8.css">
  <script src="../vendor/js/jquery-3.5.1.js"></script>
  <script src="../vendor/js/bootstrap.js"></script>
  <link rel="stylesheet" href="../vendor/css/bootstrap.css">
  <link rel="stylesheet" href="../vendor/fontawesome/all.css">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com"> <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <h1 class="header"><span>Reset Your Password</span></h1>
  <main class="cont1">
    <form method="POST" class="form-wrapper">
      <fieldset class="fs-wrapper">
        <legend class="legend-wrapper"></legend>
        <div class="cont2">
          <input class="inp1" type="text" name="fullname" id="fullname" placeholder="Enter Your Full Name" required>
        </div>
        <div class="cont2">
          <input class="inp1" type="email" name="email" id="email" placeholder="Enter Your Email" required>
        </div>
      </fieldset>
      <div class="reset">
        <input class="btn1" type="submit" value="Reset" name="submit">
      </div>
      <hr id="wrapper">
      <div class="target1">
        <p class="signup">Return To Home ?<a href="../Index.html" class="href2">&nbsp; Home</a></p>
        <p class="footer">© PatDoc 2021. All rights reserved</p>
      </div>
    </form>
  </main>
  <!-- End -->
  <script src="assets/js/main.js"></script>

		<script src="assets/js/login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	
</body>

</html>