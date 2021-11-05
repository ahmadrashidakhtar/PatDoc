<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();

if(isset($_POST['submit']))
{	
	$docid=$_SESSION['id'];
	$patname=$_POST['patname'];
$patcontact=$_POST['patcontact'];
$patemail=$_POST['patemail'];
$gender=$_POST['gender'];
$pataddress=$_POST['pataddress'];
$patage=$_POST['dob'];
$medhis=$_POST['medhis'];
$blood_group=$_POST['blood_group'];
$height=$_POST['height'];
$weight=$_POST['weight'];
$sql=mysqli_query($con,"insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientDOB,PatientMedhis,Blood_group,height,weight) values('$docid','$patname','$patcontact','$patemail','$gender','$pataddress','$patage','$medhis','$blood_group','$height','$weight')");
if($sql)
{
echo "<script>alert('Patient info added Successfully');</script>";
header('location:AddPatient.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add patient</title>
  <link rel="stylesheet" href="../vendor/css/Style7.css">
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">

  <!-- CDN Links -->
  <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /> <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#patemail").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>

<body>

  <!-- Top Navbar-->
  <div class>
    <nav class="navbar navbar-light bg-light">
      <span class="navbar-brand h1">PatDoc</span>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="./Dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./Rewards.html">Rewards</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-secondary" type="button">Logout</button>
          </div>
        </li>
      </ul>

    </nav>
  </div>
  <!--Add patient form-->
  <main>
    <form class="container" method="post">

      <legend style="text-align: left; padding-top:  2%; padding-bottom:1%;">Add <span style="color: blue;">New</span>
        Patient</legend>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name"><b>Patient's Name</b></label>
          <input class="form-control" type="text" name="patname" id="name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="phno"><b>Mobile Number</b></label>
          <input class="form-control" type="tel" name="patcontact" id="patcontact" required>
        </div>
        <div class="form-group col-md-6">
          <label for="phno"><b>Date of Birth</b></label>
          <input class="form-control" type="date" name="dob" id="dob">
        </div>

        <div class="form-group col-md-6">
          <label for="email"><b>Email</b></label>
          <input class="form-control" type="email" name="patemail" id="patemail" onBlur="userAvailability()">
          <span id="user-availability-status1" style="font-size:12px;"></span>
        </div>
        <div class="form-group col-md-3">
          <label for="gender"><b>Gender</b></label>
          <br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male">
            <label class="form-check-label" for="male" value="male">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
            <label class="form-check-label" for="female" value="female">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="other" value="other">
            <label class="form-check-label" for="other" value="other">Other</label>
          </div>
        </div>
        <div class="form-group col-md-3">
          <label for="blood_group">Blood Group</label>
          <select class="form-control" id="blood_group" name="blood_group">
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="inputHeight"><b>Height</b></label>
          <input class="form-control" type="number" name="height" id="inputHeight" placeholder="cm">
        </div>
        <div class="form-group col-md-3">
          <label for="inputWeight"><b>Weight</b></label>
          <input class="form-control" type="number" name="weight" id="inputWeight" placeholder="kg">
        </div>

        <div class="form-group col-md-12">
          <label for="inputAddress"><b> Address</b></label>
          <input type="text" class="form-control" id="inputAddress" name="pataddress">
        </div>
        <div class="form-group col-md-12">
          <label for="Medical_history"><b>Medical History</b></label>
          <textarea class="form-control" id="txtarea" placeholder="Enter Patient's Medical History (if any)" name="medhis"></textarea>
        </div>

        <div>
          <button type="submit" class="btn btn-primary" name="submit">Add</button>
        </div>
      </div>
</body>

</html>