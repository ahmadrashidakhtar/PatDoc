<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$address=$_POST['address'];
$city=$_POST['city'];
$phone=$_POST['phone'];

$sql=mysqli_query($con,"Update patient_user set fullName='$fname',address='$address',city='$city',phone='$phone' where id='".$_SESSION['id']."'");
if($sql)
{
$msg="Your Profile updated Successfully";


}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient | EditProfile</title>
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
  <script src="../vendor/js/jquery-3.5.1.js"></script>
   <script src="../vendor/js/bootstrap.js"></script>
   <link rel="stylesheet" href="../vendor/css/bootstrap.css">
   <link rel="stylesheet" href="../vendor/css/profile.css">
   <link rel="stylesheet" href="../vendor/fontawesome/all.css">
</head>
<body style="background-color:#d0e8f2!important">
      <!-- Top Navbar-->
      <div class="cont-1">
        <nav class="navbar navbar-light bg-light top-nav">
            <span class="navbar-brand h1 ">PatDoc</span>
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
<div class="container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                               
                                <h3 class="f-w-600">PatDoc |<span style="color: blue;"> Profile</span> </h3>
                                <div class="zoom">
                                        <img src="" id="avtr" height="75" width="75" alt="Fetching Profile">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-8">  
                            <div class="card-block">
                          <?php 
$sql=mysqli_query($con,"select * from patient_user where id='".$_SESSION['id']."'");
while($data=mysqli_fetch_array($sql))
{
?>
<h4><?php echo strtoupper( htmlentities($data['fullName']));?>'s Profile</h4>
<p><b>Profile Reg. Date: </b><?php echo htmlentities($data['regDate']);?></p>
<?php if($data['updationDate']){?>
<p><b>Profile Last Updation Date: </b><?php echo htmlentities($data['updationDate']);?></p>
<?php } ?>
                            <form role="form" name="edit" method="post">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Name</p>
                                        <input type="text" id="name" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']);?>" >
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <input type="email" name="uemail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($data['email']);?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <input type="text" name="phone" class="form-control" required="required"  value="<?php echo htmlentities($data['phone']);?>" >
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Gender</p>
                                        <select name="gender" class="form-control" required="required" >
<option value="<?php echo htmlentities($data['gender']);?>"><?php echo htmlentities($data['gender']);?></option>
<option value="male">Male</option>	
<option value="female">Female</option>	
<option value="other">Other</option>	
</select>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">City</p>
                                        <input type="text" name="city" class="form-control" required="required"  value="<?php echo htmlentities($data['city']);?>" >
                                    </div>
                               
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <input type="text" name="address" class="form-control" required="required"  value="<?php echo htmlentities($data['address']);?>" >
                                    </div>
                                  
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                <div class="row">
                                  
                                    <div>
                                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                    <a href="change-password.php" class="btn btn-warning">Change Password</a>
                                    </div>
                                </div>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer" style="text-align: center;padding-top: 5%; padding-bottom: 1%;">
  </div>
    </div>
</div>
<script src="../vendor/js/Script9.js"></script>
</body>
</html>