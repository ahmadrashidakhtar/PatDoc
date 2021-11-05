<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();

if(isset($_POST['submit']))
{
  $Redeem=$_POST['Redeem'];
  $specilization=$_POST['Doctorspecialization'];
$doctorid=$_POST['doctor'];
$userid=$_SESSION['id'];
$fees=$_POST['fees'];
$appdate=$_POST['appdate'];
$time=$_POST['apptime'];
$userstatus=1;
$docstatus=1;
  $ret=mysqli_query($con,"SELECT * FROM pacos WHERE redeem='$Redeem' and status='1' and patientId='$userid'");
  $num=mysqli_fetch_array($ret);
  if($num>0){
      
$update1=mysqli_query($con,"UPDATE pacos set status='0' where redeem='$Redeem' and patientId='$userid'");


$query=mysqli_query($con,"INSERT into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,paymentStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','1')");
	if($query)
	{
		echo "<script>alert('Your appointment successfully booked with Redeem Code');</script>";
    $point=mysqli_query($con,"INSERT into pacos(patientId,points) values('".$_SESSION['id']."','10')");
    $point2=mysqli_query($con,"INSERT into docos(doctorId,points) values('$doctorid','10')");
	}
  }
  else{
    $query=mysqli_query($con,"INSERT into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,paymentStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','0')");
    if($query)
    {
      echo "<script>alert('Your appointment successfully booked without Redeem Code');</script>";
      $point=mysqli_query($con,"INSERT into pacos(patientId,points) values('".$_SESSION['id']."','10')");
      $point2=mysqli_query($con,"INSERT into docos(doctorId,points) values('$doctorid','10')");
    }
  }
}
if(isset($_POST['razorPayment']))
{
  
$specilization=$_POST['Doctorspecialization'];
$doctorid=$_POST['doctor'];
$userid=$_SESSION['id'];
$fees=$_POST['fees'];
$appdate=$_POST['appdate'];
$time=$_POST['apptime'];
$userstatus=1;
$docstatus=1;
$query=mysqli_query($con,"INSERT into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus,paymentStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus','1')");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>


  <!-- CDN Links -->
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <script src="../vendor/js/jquery-3.5.1.js"></script>
   <script src="../vendor/js/bootstrap.js"></script>
   <link rel="stylesheet" href="../vendor/css/bootstrap.css">
   <link rel="stylesheet" href="../vendor/css/Style5.css">
   <link rel="stylesheet" href="../vendor/fontawesome/all.css">
   <script>
   function enable_text(status)
{
status=!status;	
	document.book.other_text.disabled = status;
}
   </script>
   <script>
function getdoctor(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'specilizationid='+val,
	success: function(data){
		$("#doctor").html(data);
	}
	});
}
</script>	

<script>
function getfee(val) {
	$.ajax({
	type: "POST",
	url: "get_doctor.php",
	data:'doctor='+val,
	success: function(data){
		$("#fees").html(data);
	}
	});
}
</script>	
</head>

</head>

<body>
  <!--Navbar-->
  <div>
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
          <a class="btn btn-secondary" href="./logout.php">Logout</a>
          </div>
        </li>
      </ul>

    </nav>
  </div>
  <!---Body-->
  <div class="container">
  <p class="text-danger"><?php echo htmlentities($_SESSION['msg1']);?>
								<?php echo htmlentities($_SESSION['msg1']="");?></p>	
    <form class="container" id="appointment" name="book" method="post">
      <h1 style="text-align: left; padding-top:  2%; padding-bottom:1%;"><span style="color: blue;">Patient</span> |
        Book Appointment</h1>
      <div class="form-row">
    
        <div class="form-group col-md-12">
          <label for="Doctor_Specialization"><b>Doctor Specialization</b></label>
          <select class="form-control" id="Doctor_Specialization" name="Doctorspecialization" onChange="getdoctor(this.value);" required>
            <!---Add doctor specialization-->
            <option value="">Select Specialization</option>
            <?php $ret=mysqli_query($con,"select * from doctorspecilization");
while($row=mysqli_fetch_array($ret))
{
?>
																<option value="<?php echo htmlentities($row['specilization']);?>">
																	<?php echo htmlentities($row['specilization']);?>
																</option>
																<?php } ?>
          </select>

        </div>
        <div class="form-group col-md-12">

          <label for="Doctor_Name"><b>Doctor</b></label>
          <select class="form-control" id="doctor" onChange="getfee(this.value);" required name="doctor">
            <option value="">Select Doctor</option>
           
          </select>

        </div>
        <div class="form-group col-md-12">
          <label for="Consultancy_Fees"><b>Consultancy Fees</b></label>
          <select name="fees" class="form-control" id="fees"  readonly></select>
										
        </div>

        <div class="form-group col-md-6">
          <label for="date_appointment"><b>Date</b></label>
          <input class="form-control date-picker" type="date" name="appdate" id="date_appointment" data-date-format="yyyy-mm-dd" required>
        </div>

        <div class="form-group col-md-6">
          <label for="time_appointment"><b>Time</b></label>
          <input class="form-control" type="time" name="apptime" id="time_appointment" required>
        </div>
        <div class="form-group col-md-12 form-check">
        <script type="text/javascript">
    function EnableDisableTextBox(redeemCode) {
        var txtPassportNumber = document.getElementById("txtCodeNumber");
        txtPassportNumber.disabled = redeemCode.checked ? false : true;
        if (!txtPassportNumber.disabled) {
            txtPassportNumber.focus();
        }
    }
</script>
<label for="redeemCode">

<label><b>Having a Redeem Code: </b></label>
    
<input  type="checkbox" id="redeemCode" name="redeemCodeCheck" onclick="EnableDisableTextBox(this)" />   
</label>
<br />
<label><b>Redeem Code: </b></label>

<input type="text" id="txtCodeNumber" disabled="disabled" class="form-control" name="Redeem" onBlur="userAvailability()" />
<span id="user-availability-status1" style="font-size:12px;"></span>
        </div>
        <div>
          <div>
   </div>       

    <button type="submit" name="submit" class="btn btn-primary">Book</button>
    <button type="submit" name="razorPayment" class="btn btn-primary">Pay Now</button>
  
    
        </div>
      </div>
  </div>
  <!---footer-->
  <div class="footer" style="text-align: center;padding-top: 5%; padding-bottom: 1%;">
    <span style="font-size:1.5em;">© PatDoc 2021. All rights reserved</span>
  </div>
  <script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availabilityRedeem.php",
data:'Redeem='+$("#txtCodeNumber").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>	

</body>

</html>