<?php
session_start();
error_reporting(0);
include('..\include\config.php');
include('.\checklogin.php');
check_login();
if(isset($_GET['cancel']))
		  {
mysqli_query($con,"update appointment set doctorStatus='0' where id ='".$_GET['id']."'");
                  $_SESSION['msg']="Appointment canceled !!";
		  }
          
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
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

    <!-- Header -->
    <section id="page-title">
        <div style="padding: 2%;">
            <h2>Doctor |<span style="color: blue;"> Appointment History </span></h2>
        </div>
    </section>

    <!-- content -->
    <section style="padding: 2%;">
        <div class="table-responsive table-bordered table-hover">
        <p class="text-danger"><?php echo htmlentities($_SESSION['msg']);?>
								<?php echo htmlentities($_SESSION['msg']="");?></p>	
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>serial #</th>
                        <th>Patient Name</th>
                        <th>Specialization</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Appointment Creation Date</th>
                        <th>Consultancy Fee</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$sql=mysqli_query($con,"select patient_user.fullName as fname,appointment.*  from appointment join patient_user on patient_user.id=appointment.userId where appointment.doctorId='".$_SESSION['id']."'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $row['fname'];?></td>
                        <td><?php echo $row['doctorSpecialization'];?></td>
                        <td><?php echo $row['appointmentDate'];?></td>
                        <td><?php echo
												 $row['appointmentTime'];?></td>
                        <td><?php echo $row['postingDate'];?></td>
                        <td><?php echo $row['consultancyFees'];?></td>
                        <td><?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
{
	echo "Active";
}
if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
{
	echo "Cancel By Patient";
}

if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
{
	echo "Cancel By You";
}



												?></td>
                        <td><div><?php if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
{ ?>

													
	<a href="Appointments.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')"class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
	<?php } else {

		echo "Canceled";
		} ?></div></td>
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