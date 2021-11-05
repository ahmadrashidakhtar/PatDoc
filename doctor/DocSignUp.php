<?php
include('..\include\config.php');
if(isset($_POST['submit']))
{
$fname=$_POST['name'];
$address=$_POST['address'];
$specilization=$_POST['spec'];
$fee=$_POST['fee'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phone=$_POST['phno'];
$password=SHA1($_POST['password']);
$query=mysqli_query($con,"insert into doctor_user(doctorname,address,specilization,fee,gender,Email,phone,password) values('$fname','$address','$specilization','$fee','$gender','$email','$phone','$password')");
if($query)
{
  $point=mysqli_query($con,"INSERT into docos(doctorId,points) values((SELECT id from doctor_user where Email='$email' && doctorName='$fname'),'500')");
	echo "<script>alert('Successfully Registered. You can login now');</script>";
	//header('location:PatLogin.php');
}
}
?>


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient SignUp</title>
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <link rel="stylesheet" href="../vendor/css/Style4.css">

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
          <label class="lbl" for="address">Clinic Address</label>
          <input class="inp1" type="text" name="address" required id="addr">
        </div>
        <div class="cont2">
          <label class="lbl" for="specilization">Specilization</label>
          <select name="spec" class="inp3" required name="specilization" id="specilization">
            <option value="">Select Specialization</option>
            <option value="Gynecologist/Obstetrician">Gynecologist/Obstetrician</option>
            <option value="General Physician">General Physician</option>
            <option value="Dermatologist">Dermatologist</option>
            <option value="Homeopathi">Homeopathi</option>
            <option value="Ayurveda">Ayurveda</option>
            <option value="Dentist">Dentist</option>
            <option value="ENT Specialist">ENT Specialist</option>
            <option value="Bone Specialist">Bone Specialist</option>
          </select>
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
          <label class="lbl" for="phno">Contact Number</label>
          <input class="inp2" type="tel" name="phno" required id="phno">
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
          <label class="lbl" for="city">Consultancy Fee</label>
          <input class="inp1" type="text" name="fee" required id="city">
        </div>
      </fieldset>
      <div class="signin">
        <button class="btn1" name="submit" type="submit">Sign Up</button>
      </div>
      <hr id="wrapper">
      <div class="target1">
        <p class="signup">Already have a Account?! <a href="./DocLogin.php" class="href2">&nbsp; SignIn</a></p>
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