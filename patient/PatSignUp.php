<?php
include('..\include\config.php');
if(isset($_POST['submit']))
{
$fname=$_POST['name'];
$address=$_POST['address'];
$city=$_POST['city'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phone=$_POST['phno'];
$password=SHA1($_POST['password']);
$query=mysqli_query($con,"insert into patient_user(fullname,address,city,gender,email,phone,password) values('$fname','$address','$city','$gender','$email','$phone','$password')");
if($query)
{
	echo "<script>alert('Successfully Registered. You can login now');</script>";
  $point=mysqli_query($con,"INSERT into pacos(patientId,points) values((SELECT id from patient_user where email='$email' && fullname='$fname'),'200')");
//	header('location:PatLogin.php');
}
}
?>


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient SignUp</title>
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <link rel="stylesheet" href="../vendor/css/Style2.css">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
  
  <script type="text/javascript">
  function valid()
                  {
                    if(document.registration.password.value!= document.registration.confirmpassword.value)
                      {
                        alert("Password and Confirm Password Field do not match  !!");
                          document.registration.confirmpassword.focus();
                            return false;
                      }
                    return true;
                  }
</script>
</head>

<body>
  <!-- Form -->
  <h1 class="header">PatDoc</h1>
  <main class="cont1">
    <form name="registration" id="registration" method="POST" class="form-wrapper" onSubmit="return valid();">
      <fieldset class="fs-wrapper">
        <legend class="legend-wrapper">Create A New Account</legend>
        <div class="cont2">
          <label class="lbl" for="Name">Full Name</label>
          <input class="inp1" type="text" name="name" required id="name">
        </div>
        <div class="cont2">
          <label class="lbl" for="address">Address</label>
          <input class="inp1" type="text" name="address" required id="addr">
        </div>
        <div class="cont2">
          <label class="lbl" for="city">City</label>
          <input class="inp1" type="text" name="city" required id="city">
        </div>
        <div class="cont2">
          <label class="lbl gen" for="gender">Gender</label>
          <input class="gen" type="radio" name="gender" id="male" value="male"> Male
          <input class="gen" type="radio" name="gender" id="female" value="female"> Female
        </div>
        <div class="cont2">
          <label class="lbl" for="usrname">Email</label>
          <input class="inp1" type="email" name="email" required id="email" onBlur="userAvailability()">
          <span id="user-availability-status1" style="font-size:12px;"></span>
        </div>
        <div class="cont2">
          <label class="lbl" for="password">Password</label>
          <input class="inp2" type="password" name="password" required id="pass">
        </div>
        <div class="cont2">
          <label class="lbl" for="password">Confirm Password</label>
          <input class="inp2" type="password" name="confirmpassword" required id="pass">
        </div>
        <div class="cont2">
          <label class="lbl" for="phno">Contact Number</label>
          <input class="inp2" type="tel" name="phno" required id="phno">
        </div>
      </fieldset>
      <div class="signin">
        <button class="btn1" name="submit" type="submit" id="submit">Sign Up</button>
      </div>
      <hr id="wrapper">
      <div class="target1">
        <p class="signup">Already have a Account?! <a href="./PatLogin.php" class="href2">&nbsp; SignIn</a></p>
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
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	
  <!-- End -->
</body>
</html>