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
    <title>iTrace | Citizen Records</title>
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
                    <li class="active">Establishment<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredEstablishment.php">Registered Establishment</a></li>
                            <li><a href="validateEstablishment.php" class="active">Validate Establishment</a></li>
                        </ul>
                    </li>
                    <li>People<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredCitizen.php">Registered Citizen</a></li>
                            <li><a href="validateCitizen.php">Validate Citizen</a></li>
                        </ul>
                    </li>
                    <li><a href="adminrecord.php">Trace Record</a></li>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php
                    if(isset($_POST['search_people'])){
                        $search = $_POST['search'];
                        $sqlFetch1 = "SELECT * FROM [dbo].[establishment] 
                                      WHERE name LIKE '%$search%' OR registrationNo LIKE '%$search%'
                                      OR email LIKE '%$search%'
                                      AND isValid = 'false';";
                        $stmtFetch1 = sqlsrv_query($con, $sqlFetch1);
                        $rowFetch1 = sqlsrv_fetch_array($stmtFetch1, SQLSRV_FETCH_ASSOC);
                        do {
                ?>
                <tr>
                    <td><?php echo $rowFetch1['name']; ?></td>
                    <td><?php echo $rowFetch1['registrationNo']; ?></td>
                    <td><?php echo $rowFetch1['email']; ?></td>
                    <td class="td-center"><a href="establishmentValidate.php?establishment_id=<?php echo $rowFetch1['establishment_id']; ?>"><i class="fas fa-eye" id="view<?php echo $rowFetch1['establishment_id']; ?>"></i></a></td>
                </tr>
                <?php
                        }while($rowFetch1 = sqlsrv_fetch_array($stmtFetch1, SQLSRV_FETCH_ASSOC));
                    } else {
                    
                        $sqlFetch = "SELECT * FROM [dbo].[establishment] 
                                    WHERE isValid = 'false';";
                        $stmtFetch = sqlsrv_query($con, $sqlFetch);
                        $rowFetch = sqlsrv_fetch_array($stmtFetch, SQLSRV_FETCH_ASSOC);
                        if($rowFetch > 0){
                            do {
                    ?>
                    <tr>
                        <td><?php echo $rowFetch['name']; ?></td>
                        <td><?php echo $rowFetch['registrationNo']; ?></td>
                        <td><?php echo $rowFetch['email']; ?></td>
                        <td class="td-center"><a href="establishmentValidate.php?establishment_id=<?php echo $rowFetch['establishment_id']; ?>"><i class="fas fa-eye" id="view<?php echo $rowFetch['establishment_id']; ?>"></i></a></td>
                    </tr>
                    <?php
                            }while($rowFetch = sqlsrv_fetch_array($stmtFetch, SQLSRV_FETCH_ASSOC));
                        } else {
                    ?>
                    <tr>
                        <td>No data found</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>