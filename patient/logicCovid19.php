<?php
$jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
$data = json_decode($jsonData,true);
foreach($data as $key => $value){
    $days_count=count($value)-1;
    $days_count_prev=$days_count-1;
}
?>