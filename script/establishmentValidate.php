<?php
session_start();
include_once("connection.php");

$username = $_SESSION['username'];


if(empty($username)){
    header("Location: login.php");
}

$user_id = $_GET['establishment_id'];

if(isset($_POST['valid_btn'])){
    $isValid = $_POST['isValid'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($isValid)){
        echo "Required all input fields. Not valid";
    } else {
        $sqlUpdateUser = "UPDATE [dbo].[establishment] 
                          SET isValid = '$isValid'
                          WHERE establishment_id = $user_id;
                          
                         ";
        $stmtUpdateUser = sqlsrv_prepare($con, $sqlUpdateUser);
        sqlsrv_execute($stmtUpdateUser);
        sqlsrv_free_stmt($stmtUpdateUser);


        require('../phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->isSMTP();


        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='ghiladam3@gmail.com';
        $mail->Password='adamadam123123';

        $mail->setFrom('ghiladam3@gmail.com', 'iTrace Incorporation');
        $mail->addAddress($email);
        $mail->addReplyTo('ghiladam3@gmail.com');


        $mail->isHTML(true);
        $mail->Subject='Be safe always. Get vaccinated anytime.';
        $mail->Body="Good day! Your establishment is now eligible to use iTrace.
                     Login Credentials<br/>
                     <b>Email: <span>$email</span></b><br/>
                     <b>Password: <span>$password</span></b>
                     ";

        if(!$mail->send()){
            echo "Message coult not be sent!";
        }else {
            echo "Message has been successfully delivered!";
        }


    
        echo "success updating data";
    }
}

if(isset($_POST['reject_btn'])){
    $email2 = $_POST['email2'];

    $message = "Your registration in iTrace is not valid. You can register again and make sure to have a valid information to get vaccinated.";

        require('../phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->isSMTP();


        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='ghiladam3@gmail.com';
        $mail->Password='adamadam123123';

        $mail->setFrom('ghiladam3@gmail.com', 'iTrace Incorporation');
        $mail->addAddress($email2);
        $mail->addReplyTo('ghiladam3@gmail.com');

        $mail->isHTML(true);
        $mail->Subject="Be safe always. Get vaccinated anytime.";
        $mail->Body="$message";

        if(!$mail->send()){
            echo "Message coult not be sent!";
        }else {
            $sqlEmail = "DELETE FROM [dbo].[establishment] WHERE establishment_id = $user_id";
            $stmtEmail = sqlsrv_prepare($con, $sqlEmail);
            sqlsrv_execute($stmtEmail);
        }


}



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
                            <li><a href="registeredEstablishment.php">Registered Establishment</a></li>
                            <li><a href="valitadeEstablishment.php" class="active">Validate Establishment</a></li>
                        </ul>
                    </li>
                    <li>People<i class="fas fa-angle-down"></i>
                        <ul>
                            <li><a href="registeredCitizen.php">Registered Citizen</a></li>
                            <li><a href="validateCitizen.php">Validate Citizen</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Trace Record</a></li>
                    <li class="searchbar"><!--<input type="search" placeholder="Search">--></li>
                </ul>
            </nav>
        </header>
        <div class="content">
            <div class="wrapper">
                <form method="POST">
                    <?php
                        $sqlFetch = "SELECT * FROM [dbo].[establishment] 
                                     WHERE establishment_id = $user_id";
                        $stmtFetch = sqlsrv_query($con, $sqlFetch);
                        $rowFetch = sqlsrv_fetch_array($stmtFetch, SQLSRV_FETCH_ASSOC);
                        if($rowFetch > 0){
                            do{
                    ?>
                        <div>Name 
                            <h3><?php echo $rowFetch['name']; ?></h3>
                        </div>
                        <div>Registration Number
                            <h3><?php echo $rowFetch['registrationNo']; ?></h3>
                        </div>
                        <div>Address
                            <h3><?php echo $rowFetch['address']; ?></h3>
                        </div>
                        <div>Email
                            <h3><?php echo $rowFetch['email']; ?></h3>
                        </div>
                        <div>Password 
                            <h3><?php echo $rowFetch['password']; ?></h3>
                        </div>
                        <div>Picture 
                            <img src="../files/<?php echo $rowFetch['picture']; ?>">
                        </div>

                        <input type="hidden" name="email" value="<?php echo $rowFetch['email']; ?>">
                        <input type="hidden" name="password" value="<?php echo $rowFetch['password']; ?>">
                        <input type="hidden" name="isValid" value="true">
                        <button type="submit" name="valid_btn" class="valid">Validate User</button>
                </form>
                <form method="post">
                        <input type="hidden" name="email2" value="<?php echo $rowFetch['email']; ?>">
                        <button type="submit" name="reject_btn" class="reject">Reject User</button>
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