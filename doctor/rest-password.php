<?php
session_start();
//error_reporting(0);
include("..\include\config.php");
// Code for updating Password
if(isset($_POST['change']))
{
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$newpassword=SHA1($_POST['password']);
$query=mysqli_query($con,"update doctor_user set password='$newpassword' where doctorName='$name' and email='$email'");
if ($query) {
echo "<script>alert('Password successfully updated.');</script>";
echo "<script>window.location.href ='DocLogin.php'</script>";
}

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Login</title>
  <link rel="icon" type="image/gif" href="../Img/Icon.png">
  <script src="../vendor/js/jquery-3.5.1.js"></script>
   <script src="../vendor/js/bootstrap.js"></script>
   <link rel="stylesheet" href="../vendor/css/bootstrap.css">
   <link rel="stylesheet" href="../vendor/css/Style1.css">
   <link rel="stylesheet" href="../vendor/fontawesome/all.css">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
  
<script type="text/javascript">
function valid()
{
 if(document.passwordreset.password.value!= document.passwordreset.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.passwordreset.password_again.focus();
return false;
}
return true;
}
</script>
</head>

<body>
  <!-- Form -->
  <h1 class="header">Doctor Login | <span>PatDoc</span></h1>
  <main class="cont1">
    <form method="POST" class="form-wrapper" onSubmit="return valid();">
      <fieldset class="fs-wrapper">
        <legend class="legend-wrapper">Reset Your Password</legend>
        <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
        <div class="cont2">
          <label class="lbl1" for="password"><b>Password</b></label>
          <input class="inp2" type="password" name="password" id="password" required>
        </div>
        <div class="cont3">
          <label class="lbl1" for="password"><b>Confirm Password</b></label>
          <input class="inp2" type="password" name="confirmpassword" id="password" required>
        </div>
       
      </fieldset>
      <div class="signin">
      <button class="btn1" name="change" type="submit">Change</button>
      </div>
      <hr id="wrapper">
      <div class="target1">
        <p class="signup">Don't have an account yet?<a href="./DocSignUp.php" class="href2">&nbsp; Sign up</a> &nbsp; |
          &nbsp; <a href="../Index.html" class="href2">Home </a></p>
        <p class="footer">© PatDoc 2021. All rights reserved</p>
      </div>
    </form>
  </main>
  <script src="..\vendor\js\main.js"></script>
		<script src="..\vendor\js\login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	<script>
 
  <!-- End -->
</body>

</html>