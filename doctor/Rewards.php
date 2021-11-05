<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
if(isset($_POST['Basic']))
{
  $point1=mysqli_query($con,"SELECT SUM(points) as tpoints from docos where doctorId='".$_SESSION['id']."'");
  while($row=mysqli_fetch_array($point1))
  {
  $point2=$row['tpoints'];
  }
  $sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title IS NULL OR title = '' and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0)
{
  if($point2>=2000){
    $query=mysqli_query($con,"INSERT into docos(doctorId,points) values('".$_SESSION['id']."','-2000')");
    $query2=mysqli_query($con,"UPDATE doctor_user set title='BASIC' where id='".$_SESSION['id']."'");
  }
  else{
    echo "<script>alert('Not enough docos, Try after earning few more');</script>";
  }
}
else{
    echo "<script>alert('Already Have Basic Title');</script>";
}
}

if(isset($_POST['Intermediate']))
{
  $point1=mysqli_query($con,"SELECT SUM(points) as tpoints from docos where doctorId='".$_SESSION['id']."'");
  while($row=mysqli_fetch_array($point1))
  {
  $point2=$row['tpoints'];
  }
  $sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title='BASIC' and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0)
{
  if($point2>=3000){
    $query=mysqli_query($con,"INSERT into docos(doctorId,points) values('".$_SESSION['id']."','-3000')");
    $query2=mysqli_query($con,"UPDATE doctor_user set title='Intermediate' where id='".$_SESSION['id']."'");
  }
  else{
    echo "<script>alert('Not enough docos, Try after earning few more');</script>";
  }
}
else
{
$sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title IS NULL OR title = '' and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0){
    echo "<script>alert('Please acheive Basic Title');</script>";
}

else{
    echo "<script>alert('Already Have Intermediate Title');</script>";
}
}
}

if(isset($_POST['Expert']))
{
  $point1=mysqli_query($con,"SELECT SUM(points) as tpoints from docos where doctorId='".$_SESSION['id']."'");
  while($row=mysqli_fetch_array($point1))
  {
  $point2=$row['tpoints'];
  }
  $sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title='Intermediate' and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0)
{
  if($point2>=4000){
    $query=mysqli_query($con,"INSERT into docos(doctorId,points) values('".$_SESSION['id']."','-4000')");
    $query2=mysqli_query($con,"UPDATE doctor_user set title='Expert' where id='".$_SESSION['id']."'");
  }
  else{
    echo "<script>alert('Not enough docos, Try after earning few more');</script>";
  }
}
else
{
$sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title IS NULL OR title = '' OR title = 'BASIC'  and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0){
    echo "<script>alert('Please acheive Intermediate Title');</script>";
}

else{
    echo "<script>alert('Already Have Expert Title');</script>";
}
}
}

if(isset($_POST['Special']))
{
  $point1=mysqli_query($con,"SELECT SUM(points) as tpoints from docos where doctorId='".$_SESSION['id']."'");
  while($row=mysqli_fetch_array($point1))
  {
  $point2=$row['tpoints'];
  }
  $sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title='Expert' and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0)
{
  if($point2>=5000){
    $query=mysqli_query($con,"INSERT into docos(doctorId,points) values('".$_SESSION['id']."','-5000')");
    $query2=mysqli_query($con,"UPDATE doctor_user set title='Special' where id='".$_SESSION['id']."'");
  }
  else{
    echo "<script>alert('Not enough docos, Try after earning few more');</script>";
  }
}
else
{
$sql=mysqli_query($con,"SELECT * FROM doctor_user WHERE title IS NULL OR title = '' OR title = 'Intermediate' OR title='Basic' and id='".$_SESSION['id']."'");
  $num=mysqli_fetch_array($sql);
if($num>0){
    echo "<script>alert('Please acheive Expert Title');</script>";
}

else{
    echo "<script>alert('Already Have PATDOC Special Title');</script>";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>
    <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
    <link rel="stylesheet" href="../vendor/css/Style7.css">

    <!-- CDN Links -->
    <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /> <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" onclick="logout()">Logout</button>
                    </div>
                </li>
            </ul>
        </nav>
        </div>    
            <div class="container">
                <div class="row">
                    <div class="col card-1">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Total Docos 🎫</h5>
                                <p class="card-text" id="total"><?php $point=mysqli_query($con,"SELECT SUM(points) as tpoints from docos where doctorId='".$_SESSION['id']."'");
                  while($row=mysqli_fetch_array($point))
                  {
                  echo $row['tpoints'];
                  }
                  ?></p>

                            </div>
                        </div>
                    </div>
                    <div class="col card-2">
                        <div class="card" style="width: 40rem;">
                            <div class="card-body">
                                <h5 class="card-title">Exchage Docos </h5>
                                <form action="" method="POST">
                                <p class="card-text">Exchange and get your <span class="text-success">Basic Title</span>  with 2000 Docos </p>
                                <button class="btn btn-success" type="submit" name="Basic">Basic</button>
                                <p class="card-text">Exchange and get your Intermediate Title with 3000 Docos </p>
                                <button class="btn btn-secondary" type="submit" name="Intermediate">Intermediate</button>
                                <p class="card-text">Exchange and get your Expert Title with 4000 Docos </p>
                                <button class="btn btn-secondary" type="submit" name="Expert">Expert</button>
                                <p class="card-text">Exchange and get your PATDOC Special Title with 5000 Docos </p>
                                <button class="btn btn-secondary" type="submit" name="Special">PATDOC Specail Title</button>
                                </form>
                            </div>
                        </div>
                        <div class="alert alert-success msg" id="msg" role="alert"></div>
                    </div>
        </nav>
    </div>
    <section class="ph3 ph5-ns pv5">
        <article class="mw8 center br2 ba b--light-blue bg-lightest-blue">
          <div class="dt-ns dt--fixed-ns w-100">
            <div class="pa3 pa4-ns dtc-ns v-mid">
              <div>
                <h2 class="fw4 blue mt0 mb3">FAQ Page</h2>
                <p class="black-70 measure lh-copy mv0">
                  Have any Queries or Doubts about our Working of Reward System ? Visit our FAQ Page And Get Answers for it.  
                </p>
              </div>
            </div>
            <div class="pa3 pa4-ns dtc-ns v-mid">
              <a href="./FAQ.html" class="no-underline f6 tc db w-100 pv3 bg-animate bg-blue hover-bg-dark-blue white br2">FAQ Page Here 👉🏻</a>
            </div>
          </div>
        </article>
      </section> 
<script src="../vendor/js/Script.js"></script>    
</body>

</html>