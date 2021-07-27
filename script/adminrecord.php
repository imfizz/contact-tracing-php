<?php

session_start();
include_once("connection.php");
$username = $_SESSION['username'];

if(isset($_POST['$username'])){
    header("Location: doh.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOH Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/validateCitizen.css">
    <link rel="icon" type="image/png" href="../images/virus.png">
</head>
<body>
<div class="main-container">
        <header>
            <div class="top-nav">
                <div class="contact-wrapper">
                    <i class="fas fa-phone-alt"></i>
                    <p>711 - 62 - 85/711 - 61 - 40</p>
                </div>
                <div class="logo-wrapper">
                    <div class="logo"></div>
                    <div class="logo-name">
                        <h1>iTrace</h1>
                    </div>
                </div>
                <div class="user-wrapper">
                    <i class="fas fa-user"></i>
                    <p><a href="logout.php">LOG OUT</a></p>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li>Establishment<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredEstablishment.php">Registered Establishment</a></li>
                            <li><a href="validateEstablishment.php">Validate Establishment</a></li>
                        </ul>
                    </li>
                    <li>People<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredCitizen.php">Registered Citizen</a></li>
                            <li><a href="validateCitizen.php">Validate Citizen</a></li>
                        </ul>
                    </li>
                    <li><a href="adminrecord.php" class="active">Trace Record</a></li>
                    <li class="searchbar">
                        <form method="post">
                            <input type="search" placeholder="Search" name="search">
                            <button type="submit" name="search_people"></button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="content">
            <table>
                <tr>
                    <th>Citizen Key</th>
                    <th>Name</th>
                    <th>Establishment Name</th>
                    <th>Time</th>
                    <th>Date</th>
                </tr>
                <?php 
                    if(isset($_POST['search_people'])){
                        $search = $_POST['search'];
                    
                        $sqlRecord = "SELECT a.*, b.*, c.establishment_id, c.name AS estabname
                                    FROM record a
                                    INNER JOIN [dbo].[user] b
                                    ON a.user_citizen_id = b.user_id
                                    INNER JOIN establishment c
                                    ON a.establishment_establishment_id = c.establishment_id

                                    WHERE b.lastname LIKE '%$search%' OR
                                    b.firstname LIKE '%$search%' OR
                                    b.middlename LIKE '%$search%'
                                    ";
                        $stmtRecord = sqlsrv_query($con, $sqlRecord);
                        $rowRecord = sqlsrv_fetch_array($stmtRecord, SQLSRV_FETCH_ASSOC);
                        if($rowRecord > 0){
                            do {
                        ?>
                            <tr>
                                <td><?php echo $rowRecord['citizen_key']; ?></td>
                                <td><?php echo $rowRecord['lastname'].", ".$rowRecord['firstname']." ".$rowRecord['middlename']; ?></td>
                                <td><?php echo $rowRecord['estabname']; ?></td>
                                <td><?php echo $rowRecord['time']; ?></td>
                                <td><?php echo $rowRecord['date']->format('M d, Y'); ?></td>
                            </tr>
                        <?php
                            }while($rowRecord = sqlsrv_fetch_array($stmtRecord, SQLSRV_FETCH_ASSOC));
                        }
                    } else {
                        $sqlRecord = "SELECT a.*, b.*, c.establishment_id, c.name AS estabname
                                    FROM record a
                                    INNER JOIN [dbo].[user] b
                                    ON a.user_citizen_id = b.user_id
                                    INNER JOIN establishment c
                                    ON a.establishment_establishment_id = c.establishment_id
                                    ";
                        $stmtRecord = sqlsrv_query($con, $sqlRecord);
                        $rowRecord = sqlsrv_fetch_array($stmtRecord, SQLSRV_FETCH_ASSOC);
                        if($rowRecord > 0){
                            do {
                        ?>
                            <tr>
                                <td><?php echo $rowRecord['citizen_key']; ?></td>
                                <td><?php echo $rowRecord['lastname'].", ".$rowRecord['firstname']." ".$rowRecord['middlename']; ?></td>
                                <td><?php echo $rowRecord['estabname']; ?></td>
                                <td><?php echo $rowRecord['time']; ?></td>
                                <td><?php echo $rowRecord['date']->format('M d, Y'); ?></td>
                            </tr>
                        <?php
                            }while($rowRecord = sqlsrv_fetch_array($stmtRecord, SQLSRV_FETCH_ASSOC));
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
