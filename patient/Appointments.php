<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
if(isset($_GET['cancel']))
		  {
mysqli_query($con,"update appointment set userStatus='0' where id ='".$_GET['id']."'");
                  $_SESSION['msg']="Appointment canceled !!";
		  }
?>
<!DOCTYPE html>
<html lang="en">
          
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History</title>
    <link rel="stylesheet" href="../vendor/css/Style5.css">
    <link rel="icon" type="image/gif" href="..\vendor\image\Icon.png">

    <!-- CDN Links -->
    <script src="../vendor/js/jquery-3.5.1.js"></script>
   <script src="../vendor/js/bootstrap.js"></script>
   <link rel="stylesheet" href="../vendor/css/bootstrap.css">
   <link rel="stylesheet" href="../vendor/fontawesome/all.css">
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

    <!-- Header -->
    <section id="page-title">
        <div style="padding: 2%;">
            <h2>Patient | Appointment History</h2>
        </div>
    </section>

    <!-- content -->
    <section style="padding: 2%;">
        <div class="table-responsive">
        <p class="text-danger"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>serial #</th>
                        <th>Doctor Name</th>
                        <th>Specialization</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Appointment Creation Date</th>
                        <th>Consultancy Fee</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Doctor Profile</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$sql=mysqli_query($con,"select doctor_user.doctorName as docname,appointment.*  from appointment join doctor_user on doctor_user.id=appointment.doctorId where appointment.userId='".$_SESSION['id']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
             
                    
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $row['docname'];?></td>
                        <td><?php echo $row['doctorSpecialization'];?></td>
                        <td><?php echo $row['appointmentDate'];?></td>
                        <td><?php echo $row['appointmentTime'];?></td>
                        <td><?php echo $row['postingDate'];?></td>
                        <td><?php echo $row['consultancyFees'];?></td>
                        <td>
                            <?php
                             if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
                                {
	                                echo "Active";
                                }
                            if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
                                {
	                                echo "Cancel by You";
                                }

                            if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
                                {
                                	echo "Cancel by Doctor";
                                }



												?></td>
                        <td>	<div class="visible-md visible-lg hidden-sm hidden-xs">
							<?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
{ ?>

													
	<a href="Appointments.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')"class="btn btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
	<?php } else {

		echo "Canceled";
		} ?>

    </div>		</td>
                        <td><a href="./DocProfile.php?doctorId=<?php echo $row['doctorId'] ?>&userId=<?php echo $_SESSION['id']?>">Doctor Profile</a></td>
                        <td><?php 
                        if($row['PaymentStatus']==1){
                            echo "Done";
                        }
                        if($row['PaymentStatus']==0){
                            echo "Not yet";
                        }
                        
                        ?></td>
                    </tr>
                    <?php 
$cnt=$cnt+1;
											 }?>
											
                </tbody>
            </table>
        </div>
    </section>
    <!-- End -->
</body>

</html>