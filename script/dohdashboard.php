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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/dohdashboard.css">
    <link rel="icon" type="image/png" href="../images/virus.png">
    <title>DOH Dashboard</title>
    <style>

        .modalview {
            padding: 100px 0;
            background: #33333391;
            display: none;
        }

        .show {
            display: block;
        }

        .modalview {
            
        }

        #find-notify {
          margin-left: auto;
          background: red;
          padding: 13px 30px;
          font-weight: bold;
          border: none;
          background: #dc2d22;
          font-size: 1.2rem;
          border-radius: 10px;
          margin: 0 0 20px 50px;
        }
    </style>
    
</head>
<body>
    <div class="main-container">
        <div class="wrapper">
            <form method="post" id="formSearch">
                <input type="text" name="citizen_key_search" placeholder="Search by key">
                <input type="date" name="date_search">
                <button type="submit" name="submit_search">Search</button>
            </form>
            
            <table>
                <tr>
                    <th>Citizen Key</th>
                    <th>Name</th>
                    <th>Establishment Name</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                <?php
                    if(isset($_POST['submit_search'])){
                        $citizen_key_search = $_POST['citizen_key_search'];
                        $date_search = $_POST['date_search'];

                        if(empty($citizen_key_search) || empty($date_search)){
                            echo "required all input fields to search";
                        } else {

                        
                                $sqlRecord = "SELECT a.*, b.*, c.establishment_id, c.name AS estabname
                                            FROM record a
                                            INNER JOIN [dbo].[user] b
                                            ON a.user_citizen_id = b.user_id
                                            INNER JOIN establishment c
                                            ON a.establishment_establishment_id = c.establishment_id

                                            WHERE b.citizen_key = '$citizen_key_search' 
                                            AND a.date BETWEEN DATEADD(DAY, -5, '$date_search') 
                                            AND '$date_search';
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
                                <td><a id="view<?php echo $rowRecord['record_id']; ?>"><i class="fas fa-eye"></i></a></td>
                            </tr>

                            <script>
                                document.querySelector("#view<?php echo $rowRecord['record_id']; ?>").onclick = function(){
                                    document.querySelector(".modalview").classList.add("show");
                                    
                                    document.querySelector("#citizen-find").value = "<?php echo $rowRecord['user_id']; ?>";
                                    document.querySelector("#establishment").value = "<?php echo $rowRecord['establishment_id']; ?>";
                                    document.querySelector("#date-find").value = "<?php echo $rowRecord['date']->format('M d, Y'); ?>";
                                    
                                }
                            </script>
                <?php
                                        }while($rowRecord = sqlsrv_fetch_array($stmtRecord, SQLSRV_FETCH_ASSOC));
                                    }
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
                                <td><a><i class="fas fa-eye"></i></a></td>
                            </tr>
                <?php
                                        }while($rowRecord = sqlsrv_fetch_array($stmtRecord, SQLSRV_FETCH_ASSOC));
                                    }
                    }
                ?>
            </table>
        
            <div class="modalview">
                <form method="post">
                    <input type="hidden" id="citizen-find" name="citizen_find">
                    <input type="hidden" id="establishment" name="establishment">
                    <input type="hidden" id="date-find" name="date_find">
                    <button type="submit" name="find" id="find-notify">Find & Notify</button>
                </form>

                <table>
                    <tr>
                        <th>Citizen Key</th>
                        <th>Name</th>
                        <th>Establishment Name</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    <?php
                        if(isset($_POST['find'])){
                            $citizen_find = $_POST['citizen_find'];
                            $establishment = $_POST['establishment'];
                            $date_find = $_POST['date_find'];

                            if(empty($citizen_find) || empty($establishment) || empty($date_find)){
                                echo "required all input fields";
                            } else {
                                $sqlFindAll = "SELECT a.*, b.*, b.email AS citizenEmail, c.establishment_id, c.name AS estabname
                                            FROM record a
                                            INNER JOIN [dbo].[user] b
                                            ON a.user_citizen_id = b.user_id
                                            INNER JOIN establishment c
                                            ON a.establishment_establishment_id = c.establishment_id

                                            WHERE a.user_citizen_id != $citizen_find 
                                            AND a.establishment_establishment_id = $establishment
                                            AND a.date = '$date_find'
                                            ";
                                $stmtFindAll = sqlsrv_query($con, $sqlFindAll);
                                $rowFindAll = sqlsrv_fetch_array($stmtFindAll, SQLSRV_FETCH_ASSOC);
                                if($rowFindAll > 0) {
                                ?>
                                    <tr>
                                        <td><?php echo $rowFindAll['citizen_key']; ?></td>
                                        <td><?php echo $rowFindAll['lastname'].", ".$rowFindAll['firstname']." ".$rowFindAll['middlename']; ?></td>
                                        <td><?php echo $rowFindAll['estabname']; ?></td>
                                        <td><?php echo $rowFindAll['time']; ?></td>
                                        <td><?php echo $rowFindAll['date']->format('M d, Y'); ?></td>
                                    </tr>
                                <?php

                                $emailNotify = $rowFindAll['citizenEmail'];
                                
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
                                $mail->addAddress($emailNotify);
                                $mail->addReplyTo('ghiladam3@gmail.com');

                                $mail->isHTML(true);
                                $mail->Subject='Attention: Covid Alert!';
                                $mail->Body='You have been exposed to a covid patient, please consult a doctor immediately.';

                                if(!$mail->send()){
                                    echo "Message coult not be sent!";
                                }else {
                                    echo "Message has been successfully delivered!";
                                }

                                    }while($rowFindAll = sqlsrv_fetch_array($stmtFindAll, SQLSRV_FETCH_ASSOC));
                                }
                            }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
