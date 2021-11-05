<?php
session_start();
error_reporting(0);
include("..\include\config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM patient_user WHERE email='".$_POST['username']."' and password='".SHA1($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="Dashboard.php";
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
// For stroing log if user login successfull
$log=mysqli_query($con,"insert into userlog (uid,username,userip,status) values ('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
	// For stroing log if user login unsuccessfull
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog (username,userip,status) values ('".$_SESSION['login']."','$uip','$status')");
$_SESSION['errmsg']="Invalid email or password";
$extra="PatLogin.php";
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
  <title>Patient Login</title>
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <link rel="stylesheet" href="../vendor/css/Style1.css">
  
  <!-- CDN Links -->
  <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Form -->
  <h1 class="header">Patient Login | <span>PatDoc</span></h1>
  <main class="cont1">
    <form method="POST" class="form-wrapper form-login">
      <fieldset class="fs-wrapper">
        <legend class="legend-wrapper">Sign In To Your Account</legend>
        <span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>

        <div class="cont2 form-group">
          <label class="lbl1" for="email"><b>Email</b></label>
          <input class="inp1" type="email" name="username" id="username" required>
        </div>
        <div class="cont3 form-group form-actions">
          <label class="lbl1" for="password"><b>Password</b></label>
          <input class="inp2" type="password" name="password" id="password" required>
        </div>
        <label class="lbl2"><a href="./ForgotPass.php" class="href1">Forgot your password?</a></label>
      </fieldset>
      <div class="signin form-actions">
      <button class="btn1" name="submit" type="submit">Sign In</button>
      </div>
      <hr id="wrapper">
      <div class="target1">
        <p class="signup">Don't have an account yet?<a href="./PatSignUp.php" class="href2">&nbsp; Sign up</a> &nbsp; |
          &nbsp; <a href="../Index.html" class="href2">Home </a></p>
        <p class="footer">© PatDoc 2021. All rights reserved</p>
      </div>
    </form>
  </main>

		<script src="..\vendor\js\login.js"></script>
		<script>
			jQuery(document).ready(function() {
		
				Login.init();
			});
		</script>
		

 
  <!---End--->
</body>

</html>