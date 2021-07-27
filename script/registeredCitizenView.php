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
                    <li>Establishment<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredEstablishment.php">Registered Establishment</a></li>
                            <li><a href="validateEstablishment.php">Validate Establishment</a></li>
                        </ul>
                    </li>
                    <li class="active">People<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredCitizen.php" class="active">Registered Citizen</a></li>
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
                        $sqlFetch = "SELECT * FROM [dbo].[user] WHERE user_id = $user_id";
                        $stmtFetch = sqlsrv_query($con, $sqlFetch);
                        $rowFetch = sqlsrv_fetch_array($stmtFetch, SQLSRV_FETCH_ASSOC);
                        if($rowFetch > 0){
                            do{
                    ?>
                        <div>Fullname 
                            <h3><?php echo $rowFetch['lastname'].", ". $rowFetch['firstname']." ". $rowFetch['middlename']." ". $rowFetch['suffix']; ?></h3>
                        </div>
                        <div>Gender 
                            <h3><?php echo $rowFetch['gender']; ?></h3>
                        </div>
                        <div>Birthday 
                            <h3><?php echo $rowFetch['birthday']->format('M d, Y'); ?></h3>
                        </div>
                        <div>Address 
                            <h3><?php echo $rowFetch['houseNo']." ".$rowFetch['street'].", ".$rowFetch['barangay'].", ".$rowFetch['city']; ?></h3>
                        </div>
                        <div>Nationality 
                            <h3><?php echo $rowFetch['nationality']; ?></h3>
                        </div>
                        <div>Civil Status 
                            <h3><?php echo $rowFetch['civilstatus']; ?></h3>
                        </div>
                        <div>Contact Number 
                            <h3><?php echo $rowFetch['contactNo']; ?></h3>
                        </div>
                        <div>Email 
                            <h3><?php echo $rowFetch['email']; ?></h3>
                        </div>

                        <div>Guardian Name 
                            <h3><?php echo $rowFetch['contactPersonLastname'].", ". $rowFetch['contactPersonFirstname']." ". $rowFetch['contactPersonMiddlename']." ". $rowFetch['contactPersonSuffix']; ?></h3>
                        </div>
                        <div>Relation 
                            <h3><?php echo $rowFetch['relation']; ?></h3>
                        </div>
                        <div>Guardian Address 
                            <h3><?php echo $rowFetch['contact_houseNo']." ".$rowFetch['contact_street'].", ".$rowFetch['contact_barangay'].", ".$rowFetch['contact_city']; ?></h3>
                        </div>
                        <div>Guardian Contact Number 
                            <h3><?php echo $rowFetch['contact_contactNo']; ?></h3>
                        </div>
                        <div>Picture 
                            <img src="../files/<?php echo $rowFetch['picture_file']; ?>">
                        </div>
                        <div>Valid ID 
                            <img src="../files/<?php echo $rowFetch['validID']; ?>">
                        </div>
                        <div>Signature
                            <img src="../files/<?php echo $rowFetch['signature']; ?>">
                        </div>
                        <input type="hidden" name="fullname" value="<?php echo $rowFetch['lastname'].", ". 
                                                                            $rowFetch['firstname']." ". 
                                                                            $rowFetch['middlename']." ". 
                                                                            $rowFetch['suffix']; 
                                                                    ?> ">
                        <input type="hidden" name="address" value="<?php echo $rowFetch['houseNo']." ".$rowFetch['street'].", ".$rowFetch['barangay'].", ".$rowFetch['city']; ?>">
                        <input type="hidden" name="birthday" value="<?php echo $rowFetch['birthday']->format('M d, Y'); ?>">
                        <input type="hidden" name="picture" value="<?php echo $rowFetch['signature']; ?>">
                        <input type="hidden" name="contact" value="<?php echo $rowFetch['contactNo']; ?>">
                        <input type="hidden" name="contactperson" value="<?php echo $rowFetch['contactPersonLastname'].", ". $rowFetch['contactPersonFirstname']." ". $rowFetch['contactPersonMiddlename']." ". $rowFetch['contactPersonSuffix']; ?>">
                        <input type="hidden" name="contactperson_contact" value="<?php echo $rowFetch['contact_contactNo']; ?>">
                        <input type="hidden" name="relation" value="<?php echo $rowFetch['relation']; ?>">

                        <input type="hidden" name="email" value="<?php echo $rowFetch['email']; ?>">
                    
                        <input type="hidden" name="isValid" value="true">
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