<?php
session_start();
include_once("connection.php");

$username = $_SESSION['username'];


if(empty($username)){
    header("Location: login.php");
}

$user_id = $_GET['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTrace | Validate User</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/userValidate.css">
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
                    <li class="active">Establishment<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredEstablishment.php" class="active">Registered Establishment</a></li>
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
            <div class="wrapper">
                <form method="get" action="makeID.php">
                    <?php
                        $sqlFetch = "SELECT * FROM [dbo].[establishment] WHERE establishment_id = $user_id";
                        $stmtFetch = sqlsrv_query($con, $sqlFetch);
                        $rowFetch = sqlsrv_fetch_array($stmtFetch, SQLSRV_FETCH_ASSOC);
                        if($rowFetch > 0){
                            do{
                    ?>
                        <div>Fullname 
                            <h3><?php echo $rowFetch['name']; ?></h3>
                        </div>
                        <div>Gender 
                            <h3><?php echo $rowFetch['registrationNo']; ?></h3>
                        </div>
                        <div>Nationality 
                            <h3><?php echo $rowFetch['address']; ?></h3>
                        </div>
                        <div>Civil Status 
                            <h3><?php echo $rowFetch['email']; ?></h3>
                        </div>
                        <div>Contact Number 
                            <h3><?php echo $rowFetch['password']; ?></h3>
                        </div>
                        <div>Email 
                            <h3><?php echo $rowFetch['picture']; ?></h3>
                        </div>

                        <div>Picture 
                            <img src="../files/<?php echo $rowFetch['picture']; ?>">
                        </div>
                </form>

                <?php
                            }while($rowFetch = sqlsrv_fetch_array($stmtFetch, SQLSRV_FETCH_ASSOC));
                        }
                    ?>
            </div>
        </div>
    </div>
</body>
</html>