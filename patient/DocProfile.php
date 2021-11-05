<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ams-patdoc";
$dId=$_GET['doctorId'];
$uId=$_GET['userId'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
 
$sql="SELECT SUM(rate_number) AS total_rate,count(id) as number_record FROM item_rating where doc = '".$dId."'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
 
function count_rate_data($rate_number)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ams-patdoc";
    $dId=$_GET['doctorId'];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql="SELECT count(id) as number_record FROM item_rating where rate_number='".$rate_number."' and doc = '".$dId."' ";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    if(!empty($data['number_record']))
    {
        return $data['number_record'];
    }
    else{
        return '0';
    }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Details</title>
  <link rel="icon" href="../vendor/image/Icon.png" type="image">
  <script src="../vendor/js/jquery-3.5.1.js"></script>
  <script src="../vendor/js/bootstrap.js"></script>
  <link rel="stylesheet" href="../vendor/css/bootstrap.css">
  <link rel="stylesheet" href="../vendor/css/profile.css">
  <link rel="stylesheet" href="../vendor/fontawesome/all.css">
</head>
<body>
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
                                <p> <span class="btn btn-warning btn-xs"><?php  
            $avgRound=$data['total_rate']/$data['number_record'];
            echo round($avgRound,2,PHP_ROUND_HALF_UP)
            ?></span> average based on <?php echo $data['number_record']; ?> reviews.</p>
            <h3><?php $query=mysqli_query($con,"select title from doctor_user where id='$dId'");
while($row=mysqli_fetch_array($query))
{
	$user_name= $row['title'];
  echo strtoupper($user_name);
}?></h3>
                            </div>
                        </div>
                        
                        <div class="col-sm-8">
                            <div class="card-block">
                            <?php 
                     
$sqlDetial=mysqli_query($con,"select * from doctor_user where id='$dId'");
$data=mysqli_fetch_array($sqlDetial);
 ?>
                           
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Name</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['doctorName']);?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['Email']);?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['phone']);?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Gender</p>
                                     
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['gender']);?></p>


                                    </div>
                                    
                               
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['address']);?></p>
                                    </div>
                                  
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Professional Background</h6>
                                <div class="row">
                                <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Specialization</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['specilization']);?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Degree</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['degree']);?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">University</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['university']);?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Graduation Date</p>
                                        <p class="m-b-10 f-w-600 text-muted"><?php echo htmlentities($data['graduationDate']);?></p>
                                    </div>

                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                <div class="row">
                                  
                                    <div>
                                   
                                    <a href="./Rate.php?doctorId=<?php echo $dId ?>&userId=<?php echo $_SESSION['id']?>" class="btn btn-success">Review</a>
                                    </div>
                                </div>
                                 
                                </div>
                          
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>