<?php
session_start();
error_reporting(0);
include("..\include\config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM doctor_user WHERE email='".$_POST['username']."' and password='".SHA1($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="Dashboard.php";
$_SESSION['dlogin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
// For stroing log if user login successfull
$log=mysqli_query($con,"insert into doctorlog (uid,username,userip,status) values ('".$_SESSION['id']."','".$_SESSION['dlogin']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
	// For stroing log if user login unsuccessfull
$_SESSION['dlogin']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into doctorlog (username,userip,status) values ('".$_SESSION['dlogin']."','$uip','$status')");
$_SESSION['errmsg']="Invalid email or password";
$extra="DocLogin.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
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
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <link rel="stylesheet" href="../vendor/css/Style3.css">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">

</head>

<body>
  <!-- Form -->
  <h1 class="header">Doctor Login | <span>PatDoc</span></h1>
  <main class="cont1">
    <form method="POST" class="form-wrapper">
      <fieldset class="fs-wrapper">
        <legend class="legend-wrapper">Sign In To Your Account</legend>
        <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
        <div class="cont2">
          <label class="lbl1" for="email"><b>Email</b></label>
          <input class="inp1" type="email" name="username" id="email">
        </div>
        <div class="cont3">
          <label class="lbl1" for="password"><b>Password</b></label>
          <input class="inp2" type="password" name="password" id="pass" required>
        </div>
        <label class="lbl2"><a href="./ForgotPass.php" class="href1">Forgot your password?</a></label>
      </fieldset>
      <div class="signin">
      <button class="btn1" name="submit" type="submit">Sign In</button>
      </div>
      <hr id="wrapper">
      <div class="target1">
        <p class="signup">Don't Have An Account Yet?<a href="./DocSignUp.php" class="href2">&nbsp; Sign up</a>&nbsp; | &nbsp; <a href="../Index.html" class="href2">Home </a></p>
        <p class="footer">© PatDoc 2021. All rights reserved</p>
      </div>
    </form>
  </main>
  <!-- End -->
  <script src="..\vendor\js\main.js"></script>
		<script src="..\vendor\js\login.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
		
	
</body>

</html>