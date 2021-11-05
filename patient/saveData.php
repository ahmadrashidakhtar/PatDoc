<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ams-patdoc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if($_POST['txtTitle'] && $_POST['txtComment'])
{

    $rate = $_POST['hdnRateNumber'];
    $title = $_POST['txtTitle'];
    $comment = $_POST['txtComment'];
    $date = date('Y-m-d H:i:s');
    $dId=$_GET['doctorId'];
$uId=$_GET['userId'];
    $sql = "INSERT INTO item_rating (rate_number,title,comment,created,doc,user) VALUES ('".$rate."', '".$title."', '".$comment."','".$date."','".$dId."','".$uId."')";

    if (mysqli_query($conn, $sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

}

?>