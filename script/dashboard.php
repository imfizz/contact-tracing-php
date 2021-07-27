<?php

session_start();
include_once("connection.php");

$username = $_SESSION['username'];

if(empty($username)){
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTrace | Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css">
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
                    <li><a href="dashboard.php" class="active">Home</a></li>
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
                    <li><a href="adminrecord.php">Trace Record</a></li>
                    <li class="searchbar"><!--<input type="search" placeholder="Search">--></li>
                </ul>
            </nav>
        </header>
        <div class="content">
            <div class="headline">
                <p>iTrace Incorporation</p>
                <h1>Contact Tracing</h1>
                <h3>When systematically applied, contact tracing will break the chains of transmission of COVID-19 and is an essential public health tool for controlling the virus.</h3>
                <a href="validateCitizen.php"><i class="fas fa-user-friends"></i>Validate Account</a>
            </div>
            <div class="slider-wrapper">
                <div class="btn active"></div>
                <div class="btn"></div>
                <div class="btn"></div>
            </div>
        </div>
    </div>
</body>
</html>