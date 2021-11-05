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
    <title>Patient Details</title>
    <link rel="icon" type="image/gif" href="../vendor/image/Icon.png">
    <link rel="stylesheet" href="../vendor/css/Style7.css">

   <!-- CDN Links -->
   <link rel="preconnect" href="https://fonts.gstatic.com"><link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /> <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
                        <button class="btn btn-secondary" type="button">Logout</button>
                    </div>
                </li>
            </ul>

        </nav>
    </div>
    <!-- Content -->
    <section id="page-title">
        <div style="padding: 2%;">
            <h2>Doctor | Patient Details</h2>
        </div>
    </section>
    <section style="padding: 2%;">
        <div class="table-responsive table-bordered">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>serial#</th>
                        <th>Patient Name</th>
                        <th>Contact No.</th>
                        <th>Gender</th>
                        <th>Creation Date</th>
                        <th>Update Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$docid=$_SESSION['id'];
$sql=mysqli_query($con,"select * from tblpatient where Docid='$docid' ");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $row['PatientName'];?></td>
                        <td><?php echo $row['PatientContno'];?></td>
                        <td><?php echo $row['PatientGender'];?></td>
                        <td><?php echo $row['CreationDate'];?></td>
                        <td><?php echo $row['UpdationDate'];?></td>
                        <td>
                            <a href="./UpdatePatient.php?editid=<?php echo $row['ID'];?>"><i class="fa fa-edit"></i></a> || <a
                                href="./ViewPatient.php?viewid=<?php echo $row['ID'];?>"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php 
$cnt=$cnt+1;
 }?>
                </tbody>
            </table>
        </div>
        <div>
            <a href="./AddPatient.php" class="btn btn-primary">Add New Patient</a>
        </div>
    </section>
    <!-- End -->
</body>

</html>