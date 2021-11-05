
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
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../vendor/js/jquery-3.5.1.js"></script>
  <script src="../vendor/js/bootstrap.js"></script>
  <link rel="stylesheet" href="../vendor/css/bootstrap.css">
 
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
  <link rel="stylesheet" href="../vendor/css/rate.css">
 
  <!-- Font Awesome Icon Library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.bar-5 {width: <?php echo (count_rate_data('5')*100)/$data['number_record'];  ?>%; height: 18px; background-color: #4CAF50;}
.bar-4 {width: <?php echo (count_rate_data('4')*100)/$data['number_record'];  ?>%; height: 18px; background-color: #2196F3;} 
.bar-3 {width: <?php echo (count_rate_data('3')*100)/$data['number_record'];  ?>%; height: 18px; background-color: #00bcd4;}
.bar-2 {width: <?php echo (count_rate_data('2')*100)/$data['number_record'];  ?>%; height: 18px; background-color: #ff9800;} 
.bar-1 {width: <?php echo (count_rate_data('1')*100)/$data['number_record'];  ?>%; height: 18px; background-color: #f44336;}
</style>
<script>
$(document).ready(function(){
    $('.rating .fa-star').click(function(){
        if($(this).hasClass('checked')) {
            $(this).toggleClass('checked');
            $(this).prevAll('.fa-star').addClass('checked');
            $(this).nextAll('.fa-star').removeClass('checked');
        }
        else
        {
            $(this).toggleClass('checked');
            $(this).prevAll('.fa-star').addClass('checked');
        }
        $("#hdnRateNumber").val($('.checked').length);
    });
    $("#frmRating").validate({
        rules: {
            txtTitle: {
                required: true
            },
            txtComment: {
                required: true
            }
        },
        submitHandler: function (form) {
            //Your code for AJAX starts
            jQuery.ajax({
                url: 'saveData.php?doctorId=<?php echo $dId ?>&userId=<?php echo $uId?>',
                type: "post",
                data: $(form).serialize(),
                success: function (data) {
                    if(data=="success")
                    {
                        window.location.reload();
                    }
                },
                error: function () {
                }
            });
        }
    });
});
</script>
</head>
<body>
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
          <a class="btn btn-secondary" href="./logout.php">Logout</a>
          </div>
        </li>
      </ul>

    </nav>
  </div>

<div class="row rating_bar rateClass">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-10">
            <p> <span class="btn btn-warning btn-xs"><?php  
            $avgRound=$data['total_rate']/$data['number_record'];
            echo round($avgRound,2,PHP_ROUND_HALF_UP)
            ?></span> average based on <?php echo $data['number_record']; ?> reviews.</p>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Rate Doctor</button>
            </div>
        </div>
        <hr style="border:3px solid #f1f1f1">
        <div class="row">
            <div class="col-lg-12">
                <div class="side"><div>5 star</div></div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-5"></div>
                    </div>
                </div>
                <div class="side right"><div><?php echo count_rate_data('5'); ?></div></div>
                <div class="side"><div>4 star</div></div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-4"></div>
                    </div>
                </div>
                <div class="side right"><div><?php echo count_rate_data('4'); ?></div></div>
                <div class="side"><div>3 star</div></div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-3"></div>
                    </div>
                </div>
                <div class="side right"> <div><?php echo count_rate_data('3'); ?></div></div>
                <div class="side"><div>2 star</div></div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-2"></div>
                    </div>
                </div>
                <div class="side right"><div><?php echo count_rate_data('2'); ?></div></div>
                <div class="side"><div>1 star</div></div>
                <div class="middle">
                    <div class="bar-container">
                        <div class="bar-1"></div>
                    </div>
                </div>
                <div class="side right"><div><?php echo count_rate_data('1'); ?></div></div>
            </div>
        </div>
    </div>
</div>
 
<div class="well rateClass">
<?php
$sql="SELECT * FROM item_rating where doc='".$dId."' ORDER by id DESC ";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>
 
<div class="row view_rating">
    <div class="col-lg-3">
       <h6><?php $patientName = $row['user'];
        $query3=mysqli_query($con,"select fullName from patient_user  where id='".$patientName."'");
while($row2=mysqli_fetch_array($query3))
{
	$user_name= $row2['fullName'];
  echo strtoupper($user_name);
}?></h6>
        <p><?php echo date('d M, Y',strtotime($row['created']));?></p>
    </div>
    <div class="col-lg-9">
        <p><span class="btn btn-warning btn-xs"><?php echo $row['rate_number'];?> <span class="fa fa-star" style="font-size: 12px;"></span></span> <?php echo $row['title'];?></p>
        <p><?php echo $row['comment'];?></p>
    </div>
</div>
<?php } ?>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
 
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="rating">
                    <span class="heading">User Rating</span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <form name="frmRating" id="frmRating">
                    <div class="form-group">
                        <label for="txtTitle">Title:</label>
                        <input type="hidden" name="hdnRateNumber" id="hdnRateNumber">
                        <input type="text" class="form-control" id="txtTitle" placeholder="Enter Title" name="txtTitle">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Comment:</label>
                        <textarea name="txtComment" id="txtComment" class="form-control" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
 
    </div>
</div>
 
</body>
</html>