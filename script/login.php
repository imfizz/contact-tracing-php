<?php
session_start();
include_once("connection.php");

if(isset($_POST['login_btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) ||
       empty($password)
    ){
        echo "Required all input fields";
    } else {

        $sqlAccount = "SELECT * FROM admin
                       WHERE username = '$username'
                       AND password = '$password'
                       AND department = 'admin'
                       ";
        $stmtAccount = sqlsrv_query($con, $sqlAccount);
        $rowAccount = sqlsrv_fetch_array($stmtAccount, SQLSRV_FETCH_ASSOC);
        if($rowAccount > 0){
            $_SESSION['username'] = $rowAccount['username'];
            header("Location: dashboard.php");
            sqlsrv_free_stmt($stmtAccount);
        } else {
            echo "No user found";
            sqlsrv_free_stmt($stmtAccount);
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
    <title>Login</title>
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
                <input type="text" name="username" id="username" required>
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