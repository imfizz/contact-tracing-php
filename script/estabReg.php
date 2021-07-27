<?php

include_once("connection.php");

if(isset($_POST['reg_btn'])){
    $name = $_POST['name'];
    $regno = $_POST['regno'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $attachment = $_FILES['attachment']['name'];

    $sqlEstablishment = "INSERT 
                         INTO [dbo].[establishment](
                                                    name,
                                                    registrationNo,
                                                    address,
                                                    email,
                                                    password,
                                                    picture,
                                                    isValid)
                                            VALUES ('$name',
                                                    '$regno',
                                                    '$address',
                                                    '$email',
                                                    '$password',
                                                    '$attachment',
                                                    'false')";
    $stmtEstablishment = sqlsrv_prepare($con, $sqlEstablishment);
    sqlsrv_execute($stmtEstablishment);
    sqlsrv_free_stmt($stmtEstablishment);
    echo "successfully created";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Establishment</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/citiReg.css">
    <link rel="icon" type="image/png" href="../images/virus.png">
</head>
<body>
    <div class="main-container">
        <form method="post" enctype="multipart/form-data">
        <h1>Register Establishment</h1>
            <label for="">Name
                <input type="text" name="name" required>
            </label>
            <label for="">Registration Number
                <input type="text" name="regno" required>
            </label>
            <label for="">Address
                <input type="text" name="address" required>
            </label>
            <label for="">Email
                <input type="email" name="email" required>
            </label>
            <label for="">Password
                <input type="password" name="password">
            </label>
            <label for="">Picture
                <input type="file" name="attachment" size="60">
            </label>
            <button type="submit" name="reg_btn">Register Establishment</button>
        </form>
    </div>
</body>
</html>