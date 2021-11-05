<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $bp=$_POST['bp'];
    $bs=$_POST['bs'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
   $pres=$_POST['pres'];
   
 
      $query=mysqli_query($con, "insert   tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$bp','$bs','$weight','$temp','$pres')");
    if ($query) {
    echo '<script>alert("Medicle history has been added.")</script>';
    echo "<script>window.location.href ='Patient.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View patient</title>
  <link rel="stylesheet" href="../vendor/css/Style7.css">
  <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">

  <!-- CDN Links -->
  <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /> <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Navbar -->
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
          <div>
            <button class="btn btn-secondary" type="button">Logout</button>
          </div>
        </li>
      </ul>

    </nav>
  </div>
  <div class="container">
  <?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblpatient where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
    <table style="margin-top: 2%;" class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th colspan="4">
          <h2><span>Patient </span> Details</h2>
        </th>
      </tr>
    </thead>
      <tr>
        <th>Patient Name</th>
        <td><?php  echo $row['PatientName'];?></td>
        <th>Patient Email</th>
        <td><?php  echo $row['PatientEmail'];?></td>
      </tr>
      <tr>
        <th>Patient Mobile Number</th>
        <td><?php  echo $row['PatientContno'];?></td>
        <th>Patient Address</th>
        <td><?php  echo $row['PatientAdd'];?></td>
      </tr>
      <tr>
        <th>Patient Gender</th>
        <td><?php  echo $row['PatientGender'];?></td>
        <th>Patient DOB</th>
        <td><?php  echo $row['PatientDOB'];?></td>
      </tr>
      <tr>
      <tr>
        <th>Patient Height</th>
        <td><?php  echo $row['Height'];?></td>
        <th>Patient Weight</th>
        <td><?php  echo $row['weight'];?></td>
      </tr>

      <th>Patient Medical History(if any)</th>
      <td><?php  echo $row['PatientMedhis'];?></td>
      <th>Blood group</th>
      <td><?php  echo $row['Blood_group'];?></td>
      </tr>
      <tr>
        <th>Patient Reg Date</th>
        <td><?php  echo $row['CreationDate'];?></td>
      </tr>
      <?php }?>
    </table>
    <?php  

$ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");



 ?>
    <table id="datatable" class="table table-bordered dt-responsive nowrap"
      style="border-collapse: collapse; border-spacing: 0; width: 100%;">
      <thead class="thead-dark">
      <tr>
        <th colspan="8">Medical History</th>
      </tr>
      <tr>
        <th>#</th>
        <th>Blood Pressure</th>
        <th>Weight</th>
        <th>Blood Sugar</th>
        <th>Body Temprature</th>
        <th>Medical Prescription</th>
        <th>Visit Date</th>

      </tr>
      </thead>
      <?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
      <tr>
        <td><?php echo $cnt;?></td>
        <td><?php  echo $row['BloodPressure'];?></td>
        <td><?php  echo $row['Weight'];?></td>
        <td><?php  echo $row['BloodSugar'];?></td>
        <td><?php  echo $row['Temperature'];?></td>
        <td><?php  echo $row['MedicalPres'];?></td>
        <td><?php  echo $row['CreationDate'];?></td>
      </tr>
      <?php $cnt=$cnt+1;} ?>
    </table>

    <p align="center">                            
 <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Medical History</button></p>  

<?php  ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">
                                                <form method="post" name="submit">

<tr>
<th>Blood Pressure :</th>
<td>
<input name="bp" placeholder="Blood Pressure" class="form-control wd-450" required="true"></td>
</tr>                          
<tr>
<th>Blood Sugar :</th>
<td>
<input name="bs" placeholder="Blood Sugar" class="form-control wd-450" required="true"></td>
</tr> 
<tr>
<th>Weight :</th>
<td>
<input name="weight" placeholder="Weight" class="form-control wd-450" required="true"></td>
</tr>
<tr>
<th>Body Temprature :</th>
<td>
<input name="temp" placeholder="Blood Sugar" class="form-control wd-450" required="true"></td>
</tr>
                   
<tr>
<th>Prescription :</th>
<td>
<textarea name="pres" placeholder="Medical Prescription" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
</tr>  

</table>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
    
  </div>

  <!-- End -->
</body>

</html>