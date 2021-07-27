<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    
<?php 
    if(isset($_POST['btn'])){
        $email = $_POST['email'];
        $file = $_FILES['file']['name'];
        $file_path = $_FILES["file"]["tmp_name"];

        require('phpmailer/PHPMailerAutoload.php');
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

        move_uploaded_file($file_path, $file);
        $mail->addAttachment($file);

        $mail->isHTML(true);
        $mail->Subject='PHP Mailer Subject';
        $mail->Body='<a href="localhost:8080\lms\files\t'.$file.'" download>Download Me</a>';

        if(!$mail->send()){
            echo "Message coult not be sent!";
        }else {
            echo "Message has been successfully delivered!";
        }
    }
?>

</body>
</html>