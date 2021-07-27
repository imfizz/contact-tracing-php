<?php

session_start();
include_once("connection.php");

if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        echo "Required all input fields";
    } else {
        $sqlLogin = "SELECT * FROM [dbo].[establishment] 
                      WHERE email = '$email'
                      AND password = '$password'";
        $stmtLogin = sqlsrv_query($con, $sqlLogin);
        $rowLogin = sqlsrv_fetch_array($stmtLogin, SQLSRV_FETCH_ASSOC);
        if($rowLogin > 0){
                $_SESSION['name'] = $rowLogin['name'];
                $_SESSION['establishment_id'] = $rowLogin['establishment_id'];
                header("Location: establishmentDashboard.php");
                sqlsrv_free_stmt($stmtLogin);
        } else {
            echo "wrong username and password";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Establishment</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
</head>
<body>
<div class="main-container">

<form method="POST">
    <div class="logo">
        <h2>iTrace</h2>
    </div>
    <h1>Login your account</h1>
    <label for="username">Username <br/>
        <input type="text" name="email" id="username" required>
    </label>
    <label for="password">Password <br/>
        <input type="password" name="password" id="password" required>
    </label>
    <button type="submit" name="login_btn">Login</button>
</form>

<div class="slider-wrapper">
    <div class="content-slider">
        <h1>Contact tracing is the process of identifying, assessing, and managing people who have been exposed to a disease to prevent onward transmission.</h1>
        <div class="profile-wrapper">
            <div class="picture"></div>
            <div class="name">
                <h3>Mikhaela Cruz</h3>
                <p>Health Official of United States</p>
            </div>
            <div class="sliders-btn">
                <div class="slider-end">
                    <div class="btn active"></div>
                    <div class="btn"></div>
                    <div class="btn"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>