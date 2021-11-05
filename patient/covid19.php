<?php
$jsonData = file_get_contents("https://pomber.github.io/covid19/timeseries.json");
$data = json_decode($jsonData,true);
foreach($data as $key => $value){
    $days_count=count($value)-1;
    $days_count_prev=$days_count-1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../vendor/js/jquery-3.5.1.js"></script>
   <script src="../vendor/js/bootstrap.js"></script>
   <link rel="stylesheet" href="../vendor/css/bootstrap.css">
   <link rel="stylesheet" href="../vendor/fontawesome/all.css">
    <title>Covid-19 Tracker</title>
</head>
<body>
    <div class="container-fluid bg-light p-5 text-center my-3">
        <h1>Covid-19 Tracker</h1>
        <h5 class="text-muted">PATDOC feature that keep track of all Covid-19 cases around the world</h5>
    </div>
    <div class="container-fluid">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Countries</th>
                    <th scope="col">Confirmed</th>
                    <th scope="col">Recovered</th>
                    <th scope="col">Deceased</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($data as $key => $value){

                
                ?>
                <tr>
                    <th><?php echo $key; ?></th>
                    <td>
                        <?php echo $value[$days_count]['confirmed']; ?>
                    </td>
                    <td>
                        <?php echo $value[$days_count]['recovered']; ?>
                    </td>
                    <td>
                        <?php echo $value[$days_count]['deaths']; ?>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>