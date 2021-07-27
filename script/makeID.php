<?php
session_start();
include_once("connection.php");

$username = $_SESSION['username'];

if(empty($username)){
    header("Location: login.php");
}

$citizen_key = $_GET['citizen_key'];


$fullname = $_GET['fullname'];
$address = $_GET['address'];
$birthday = $_GET['birthday'];
$contact = $_GET['contact'];
$contactperson = $_GET['contactperson'];
$contactperson_contact = $_GET['contactperson_contact'];
$relation = $_GET['relation'];
$picture = $_GET['picture'];

$email = $_GET['email'];

$isValid = $_GET['isValid'];
$user_id = $_GET['user_id'];

include 'barcode128.php';

if(isset($_POST['email_btn'])){
    $email = $_POST['email'];
    $attachment = $_FILES['attachment']['name'];
    $filePath = $_FILES['attachment']['tmp_name'];

        require('../phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->isSMTP();


        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        $mail->Username='ghiladam3@gmail.com';
        $mail->Password='adamadam123123';

        $mail->setFrom('ghiladam3@gmail.com', 'phpgod');
        $mail->addAddress($email);
        $mail->addReplyTo('ghiladam3@gmail.com');

        move_uploaded_file($filePath, $attachment);
        $mail->addAttachment($attachment);

        $mail->isHTML(true);
        $mail->Subject='PHP Mailer Subject';
        $mail->Body='This ID can grant you to enter the establishments';

        if(!$mail->send()){
            echo "Message coult not be sent!";
        }else {
            echo "Message has been successfully delivered!";
            $sqlUpdateUser = "UPDATE [dbo].[user] 
                              SET isValid = '$isValid', citizen_key = '$citizen_key'
                              WHERE user_id = $user_id;
                             ";
            $stmtUpdateUser = sqlsrv_prepare($con, $sqlUpdateUser);
            sqlsrv_execute($stmtUpdateUser);
            sqlsrv_free_stmt($stmtUpdateUser);
            echo "success updating data";
        }
}

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Make ID</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/FileSaver.js/2014-11-29/FileSaver.min.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300;600&display=swap");

        body {
            padding: 250px 250px;
        }

        /* * {
            
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 300;
        } */

        #citizen-wrapper {
            height: 384px;
            width: 698px;
            background-image: url("../images/bg.png");
            background-size: contain;
            background-repeat: no-repeat;
            border-radius: 10px;
            box-shadow: 0 6px 12px 1px rgba(0, 0, 0, 0.19);
        }

        #img {
            height: 118px;
            width: 117px;
            transform: translate(55px, 86px);
            border-radius: 10px;
            background-image: url("../images/face.jpg");
            background-size: cover;
            background-position: center;
        }

        #name {
            transform: translate(210px, 10px);
            font-weight: 600;
            font-family: "Roboto", sans-serif;
        }

        #address {
            transform: translate(213px, -7px);
            font-size: 12px;
            font-weight: 600;
            font-family: "Roboto", sans-serif;
        }

        #birthday {
            transform: translate(45px, 30px);
            font-weight: 600;
            font-family: "Roboto", sans-serif;
        }

        #contact {
            transform: translate(212px, -5px);
            font-weight: 600;
            font-family: "Roboto", sans-serif;
        }

        #guardianName {
            transform: translate(45px, 25px);
            font-weight: 600;
            font-family: "Roboto", sans-serif;
        }

        #guardianNameContact {
            transform: translate(212px, -10px);
            font-weight: 600;
            font-family: "Roboto", sans-serif;
        }

        #key {
            transform: translate(452px, -135px);
        }

        form {
            position: absolute;
            right: 20%;
            top: 50%;
            transform: translate(-20%, -50%);
            display: flex;
            flex-direction: column;
            background: #f3f3f3;
            padding: 20px 30px;
            border-radius: 10px;
        }

        form > label {
            display: flex;
            flex-direction: column;
            font-family: "Roboto", sans-serif;
            font-size: 1.7rem;
        }

        form > label > input {
            margin-top: 10px;
            padding: 10px 15px;
            border: 1px solid black;
            margin-bottom: 20px;
        }

        input[type="file"]{
            border: none;
            padding: 0;
            cursor: pointer;
        }

        form button {
            padding: 10px 15px; 
            font-size: 1.2rem;
            background: #DC2D22;
            border: none;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
        }

        form button:hover {
            background: #f53b2f;
        }

        ::-webkit-file-upload-button {
            background: #ddd;
            color: black;
            padding: 10px 15px;
            border: none;
            margin-right: 15px;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
        }

        #download_btn {
            background: #DC2D22;
            position: absolute;
            bottom: 220px;
            border: none;
            padding: 10px 20px;
            min-width: 200px;
            font-size: 1.3rem;
            color: white;
            text-transform: uppercase;
            cursor: pointer;
        }

        #download_btn:hover {
            background: #f53b2f;
        }
    </style>
</head>
<body>
    <div id="citizen-wrapper">
        <div id="img"></div>
        <h1 id="name"><?php echo $fullname; ?></h1>
        <p id="address"><?php echo $address; ?></p>

        <p id="birthday"><?php echo $birthday; ?></p>
        <p id="contact"><?php echo $contact; ?></p>

        <p id="guardianName"><?php echo $contactperson; ?></p>
        <p id="guardianNameContact"><?php echo $contactperson_contact; ?></p>

        <p id="key"><?php echo bar128($citizen_key); ?></p>
    </div>
    
    <button id="download_btn">Download ID</button>


    <form method="post" enctype="multipart/form-data">
        <label for="">Email
            <input type="text" name="email" value="<?php echo $email; ?>" readonly>
        </label>
        <label for="">Attachment
            <input type="file" name="attachment" size="60">
        </label>
        <button type="submit" name="email_btn">Email</button>
    </form>

<script type="text/javascript">
    var node = document.getElementById('citizen-wrapper');
    var btn = document.getElementById('download_btn');

    btn.onclick = function() {
    domtoimage.toBlob(document.getElementById('citizen-wrapper'))
        .then(function(blob) {
        window.saveAs(blob, 'citizen-wrapper.png');
        });
    }
</script>
</body>
</html>