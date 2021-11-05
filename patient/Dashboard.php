<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient | Dashboard</title>
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <link rel="stylesheet" href="../vendor/css/Style5.css">

<!-- CDN Links -->
<link rel="preconnect" href="https://fonts.gstatic.com"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /><link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</head>
<body>

  <!-- Top Navbar-->
  <div>
    <nav class="navbar navbar-light bg-light top-nav">
      <span class="navbar-brand h1 ">PatDoc</span>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="./Dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./Rewards.php">Rewards</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
          <a class="btn btn-secondary" href="./logout.php">Logout</a>
        
          </div>
        </li>
      </ul>

    </nav>
  </div>

  <!-- Header-->
  <section>
    <div style="padding: 2%;">
      <h2 class="text-dark">Welcome <span class="text-primary" id="header">		<?php $query=mysqli_query($con,"select fullName from patient_user where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
	$user_name= $row['fullName'];
  echo strtoupper($user_name);
}?></span></h2>
    </div>
  </section>

  <!-- Cards --->
  <section>
    <div style="padding-top: 5%; padding-left: 2%; padding-right: 2%;">
      <div class="row">
        <div class="col-md-3 r1">
          <div class="card text-white bg-warning">
            <div class="card-body">
              <h5 class="card-title">My Appointments &nbsp;&nbsp;<i class="fas fa-book-medical fa-2x"></i></h5>

              <a href="./Appointments.php" class="btn btn-info">Appointment History</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 r1">
          <div class="card text-white bg-success">
            <div class="card-body">
              <h5 class="card-title">Book My Appointment &nbsp;&nbsp;<i class="far fa-calendar-check fa-2x"></i></h5>

              <a href="./BookAppointment.php" class="btn btn-light">Book Appointment</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 r1">
          <div class="card text-white bg-secondary">
            <div class="card-body">
              <h5 class="card-title">My Medical History &nbsp;&nbsp;<i class="fas fa-notes-medical fa-2x"></i></h5>

              <a href="./History.php" class="btn btn-light">Medical History</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 r1">
          <div class="card text-white bg-primary">
            <div class="card-body">
              <h5 class="card-title">Know more about Pills &nbsp;&nbsp;<i class="fas fa-search fa-2x"></i></h5>

              <a href="PillIdentifier.html" class="btn btn-dark">Pill Identifier</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 r1">
          <div class="card text-white bg-dark">
            <div class="card-body">
              <h5 class="card-title">Check Drug Interaction &nbsp;&nbsp;<i class="fas fa-capsules fa-2x"></i></h5>

              <a href="DrugInteraction.html" class="btn btn-info">Drug Interaction Checker</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 r1 r2">
          <div class="card text-white bg-info">
            <div class="card-body">
              <h5 class="card-title">My Profile &nbsp;&nbsp;<i class="fas fa-id-badge fa-2x"></i></i></h5>

              <a href="./EditProfile.php" class="btn btn-dark">Update Profile</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 r1">
          <div class="card text-white bg-dark">
            <div class="card-body">
              <h5 class="card-title">Covid-19 Tracker &nbsp;&nbsp;<i class="fas fa-capsules fa-2x"></i></h5>

              <a href="covid19.php" class="btn btn-info">Drug Interaction Checker</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End -->
  
  <script src="..\vendor\js\main.js"></script>

		<script>
			jQuery(document).ready(function() {
				Main.init();
			
			});
		</script>
 
</body>

</html>