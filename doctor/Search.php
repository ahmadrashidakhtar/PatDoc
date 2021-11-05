
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
    <title>Search patient</title>
 
    <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
    <link rel="stylesheet" href="../vendor/css/Style7.css">

    <!-- CDN Links -->
    <link rel="preconnect" href="https://fonts.gstatic.com"> <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"> <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /><script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Top Navbar-->
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
                        <button class="btn btn-secondary" type="button">Logout</button>
                    </div>
                </li>
            </ul>

        </nav>
    </div>
    <div class="container">
        <legend style="text-align: left; padding-top:  2%; padding-bottom:1%;"><span style="color: blue;">Search</span>
            Patient</legend>
        <div class="row cont-1">
            <div class="col-md-12">
                <form style="padding-top: 2%;" method="post" name="search">
                    <div class="form-group">
                        <label for="doctorname">
                            <h6>Search by Name/Mobile No.</h6>
                        </label>
                        <input type="text" name="searchdata" id="searchdata" class="form-control" value=""
                            required='true'>
                    </div>
                    
                    <button type="submit" name="search" id="search" class="btn btn-primary" name="search"> Search </button>
                </form>
                <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
<h6 align="center">Result against <span style="color: blue;"><?php echo $sdata;?></span> keyword </h6>

<table class="table table-hover table-bordered" id="sample-table-1">
<thead>
<tr>
<th>#</th>
<th>Patient Name</th>
<th>Patient Contact Number</th>
<th>Patient Gender </th>
<th>Creation Date </th>
<th>Updation Date </th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$sql=mysqli_query($con,"SELECT * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
$num=mysqli_num_rows($sql);
if($num>0){
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
<tr>
<td class="center"><?php echo $cnt;?>.</td>
<td class="hidden-xs"><?php echo $row['PatientName'];?></td>
<td><?php echo $row['PatientContno'];?></td>
<td><?php echo $row['PatientGender'];?></td>
<td><?php echo $row['CreationDate'];?></td>
<td><?php echo $row['UpdationDate'];?>
</td>
<td>

<a href="UpdatePatient.php?editid=<?php echo $row['ID'];?>"><i class="fa fa-edit"></i></a> || <a href="ViewPatient.php?viewid=<?php echo $row['ID'];?>"><i class="fa fa-eye"></i></a>

</td>
</tr>
<?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
   
  <?php }} ?></tbody>
</table>

</body>

</html>