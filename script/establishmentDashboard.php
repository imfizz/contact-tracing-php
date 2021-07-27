<?php

session_start();
include_once("connection.php");
$name = $_SESSION['name'];
$establishment_id = $_SESSION['establishment_id'];

if(empty($name)){
    header("Location: loginEstablishment.php");
}

if(isset($_POST['btn_submit'])){
    $citizen_key = $_POST['citizen_key'];

    $curr_date = date("Y/m/d");
    $curr_time = date("h:i:sa");
    
    echo $curr_time;
    $sqlSelectKey = "SELECT * FROM [dbo].[user] WHERE citizen_key = '$citizen_key'";
    $stmtSelectKey = sqlsrv_query($con, $sqlSelectKey);
    $rowSelectKey = sqlsrv_fetch_array($stmtSelectKey, SQLSRV_FETCH_ASSOC);
    if($rowSelectKey > 0){
        do {
            $myid = $rowSelectKey['user_id'];
            $sqlInsert = "INSERT INTO record(user_citizen_id, establishment_establishment_id, time, date)
                                        VALUES($myid, $establishment_id, '$curr_time', '$curr_date')";
            $stmtInsert = sqlsrv_prepare($con, $sqlInsert);
            sqlsrv_execute($stmtInsert);
            sqlsrv_free_stmt($stmtInsert);
            echo "success";
        }while($rowSelectKey = sqlsrv_fetch_array($stmtSelectKey, SQLSRV_FETCH_ASSOC));
        echo "success";
    } else {
        echo "walang ganon";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establishmenet Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/establishmentDashboard.css">
    <link rel="icon" type="image/png" href="../images/virus.png">
</head>
<body>
    <div class="main-container">
        <h1>Welcome to <br/><span><?php echo $name; ?></span></h1>
        <form method="post">
            <input type="text" name="citizen_key" placeholder="Tap Barcode" autofocus>
            <button type="submit" name="btn_submit"></button>
        </form>
    </div>
</body>
</html>