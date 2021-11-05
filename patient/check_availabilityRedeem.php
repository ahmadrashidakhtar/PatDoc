<?php 
require_once("..\include\config.php");
if(!empty($_POST["Redeem"])) {
	$Redeem= $_POST["Redeem"];
	
		$result =mysqli_query($con,"SELECT redeem FROM pacos WHERE redeem='$Redeem' and status='1'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:green'> Redeem Code Exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:red'> Redeem Code does not Exist .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}

?>
