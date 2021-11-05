<?php 
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
if(isset($_POST['Redeem']))
{
  $point1=mysqli_query($con,"SELECT SUM(points) as tpoints from pacos where patientId='".$_SESSION['id']."'");
                  while($row=mysqli_fetch_array($point1))
                  {
                  $point2=$row['tpoints'];
                  }
                  $Redeemcode1=mysqli_query($con,"SELECT redeem from pacos where patientId='".$_SESSION['id']."' and status='1'");
                  $num=mysqli_fetch_array($Redeemcode1);
 if($num<1){                 
  if($point2>=100){
   
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
    function generate_string($input, $strength = 8) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
           $random_string .= $random_character;
        }
     
      return $random_string;
    }
    $redeem = generate_string($permitted_chars);
    $query=mysqli_query($con,"INSERT into pacos(patientId,points,redeem,status) values ('".$_SESSION['id']."','-100','$redeem','1')");
     
}
  
  else{
    echo "<script>alert('Not enough pacos, Try after earning few more');</script>";
  }
}
else{
  echo "<script>alert('Already having an Active Reedem code');</script>";
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
    <link rel="stylesheet" href="../vendor/css/Style5.css">
    <!-- CDN Links -->
    <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   
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
                      <a class="btn btn-secondary" href="./logout.php">Logout</a>
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
                  <h5 class="card-title">Total Pacos 🎫</h5>
                  
                  <p class="card-text" id="total"><?php $point=mysqli_query($con,"SELECT SUM(points) as tpoints from pacos where patientId='".$_SESSION['id']."'");
                  while($row=mysqli_fetch_array($point))
                  {
                  echo $row['tpoints'];
                  }
                  ?></p>
                  
                </div>
              </div>
          </div>
          <div class="col card-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Exchage Pacos </h5>
                  <p class="card-text">Exchange and get a free appointment with 100 pacos </p>
                  <form action="" method="POST">
                  <button class="btn btn-secondary" name="Redeem">Redeem</button>
                  </form>
                </div>
              </div>
              <div class="alert alert-success" id="msg" role="alert"><p>Your Currently Active Redeem Code: <?php
              
             $Redeemcode=mysqli_query($con,"SELECT redeem from pacos where patientId='".$_SESSION['id']."' and status='1' and id = (SELECT max(id) FROM pacos)");
             while($row2=mysqli_fetch_array($Redeemcode))
             {
             echo $row2['redeem'];
             }
              ?></p></div>
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
          
        </div> 


<script src="../vendor/js/Script6.js"></script>        
</body>

</html>