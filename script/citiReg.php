<?php

include_once("connection.php");

if(isset($_POST['reg_btn'])){
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $houseNo = $_POST['houseNo'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $nationality = $_POST['nationality'];
    $civilstatus = $_POST['civilstatus'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];

    $contactPersonLastname = $_POST['contactPersonLastname'];
    $contactPersonFirstname = $_POST['contactPersonFirstname'];
    $contactPersonMiddlename = $_POST['contactPersonMiddlename'];
    $contactPersonSuffix = $_POST['contactPersonSuffix'];
    $relation = $_POST['relation'];
    $contact_houseNo = $_POST['contact_houseNo'];
    $contact_street = $_POST['contact_street'];
    $contact_barangay = $_POST['contact_barangay'];
    $contact_city = $_POST['contact_city'];
    $contact_contactNo = $_POST['contact_contactNo'];
    
    $picture_file = $_FILES['picture_file']['name'];
    $validID = $_FILES['validID']['name'];
    $signature = $_FILES['signature']['name'];
    

    $sqlEstablishment = "INSERT 
                         INTO [dbo].[user](
                                           lastname,
                                           firstname,
                                           middlename,
                                           suffix,
                                           gender,
                                           birthday,
                                           houseNo,
                                           street,
                                           barangay,
                                           city,
                                           nationality,
                                           civilstatus,
                                           contactNo,
                                           email,
                                           contactPersonLastname,
                                           contactPersonFirstname,
                                           contactPersonMiddlename,
                                           contactPersonSuffix,
                                           relation,
                                           contact_houseNo,
                                           contact_street,
                                           contact_barangay,
                                           contact_city,
                                           contact_contactNo,
                                           picture_file,
                                           validID,
                                           signature,
                                           isValid
                                          )
                                  VALUES (
                                           '$lastname',
                                           '$firstname',
                                           '$middlename',
                                           '$suffix',
                                           '$gender',
                                           '$birthday',
                                           '$houseNo',
                                           '$street',
                                           '$barangay',
                                           '$city',
                                           '$nationality',
                                           '$civilstatus',
                                           '$contactNo',
                                           '$email',
                                           '$contactPersonLastname',
                                           '$contactPersonFirstname',
                                           '$contactPersonMiddlename',
                                           '$contactPersonSuffix',
                                           '$relation',
                                           '$contact_houseNo',
                                           '$contact_street',
                                           '$contact_barangay',
                                           '$contact_city',
                                           '$contact_contactNo',
                                           '$picture_file',
                                           '$validID',
                                           '$signature',
                                           'false'
                                           )";
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
        <h1>Register Citizen</h1>
            <label for="">Lastname
                <input type="text" name="lastname" required>
            </label>
            <label for="">Firstname
                <input type="text" name="firstname" required>
            </label>
            <label for="">Middlename
                <input type="text" name="middlename" required>
            </label>
            <label for="">Suffix
                <input type="text" name="suffix" required>
            </label>
            <label for="">Gender
                <input type="text" name="gender" required>
            </label>
            <label for="">birthday
                <input type="date" name="birthday" required>
            </label>
            <label for="">House Number
                <input type="text" name="houseNo" required>
            </label>
            <label for="">Street
                <input type="text" name="street" required>
            </label>
            <label for="">Barangay
                <input type="text" name="barangay" required>
            </label>
            <label for="">City
                <input type="text" name="city" required>
            </label>
            <label for="">Nationality
                <input type="text" name="nationality" required>
            </label>
            <label for="">Civil Status
                <input type="text" name="civilstatus" required>
            </label>
            <label for="">Contact Number
                <input type="text" name="contactNo" required>
            </label>
            <label for="">Email
                <input type="email" name="email" required>
            </label>
            <label for="">Contact Person Lastname
                <input type="text" name="contactPersonLastname" required>
            </label>
            <label for="">Contact Person Firstname
                <input type="text" name="contactPersonFirstname" required>
            </label>
            <label for="">Contact Person Middlename
                <input type="text" name="contactPersonMiddlename" required>
            </label>
            <label for="">Contact Person Suffix
                <input type="text" name="contactPersonSuffix" required>
            </label>
            <label for="">Relation
                <input type="text" name="relation" required>
            </label>

            <label for="">Contact House Number
                <input type="text" name="contact_houseNo" required>
            </label>
            <label for="">Contact Street
                <input type="text" name="contact_street" required>
            </label>
            <label for="">Contact Barangay
                <input type="text" name="contact_barangay" required>
            </label>
            <label for="">Contact City
                <input type="text" name="contact_city" required>
            </label>
            <label for="">Contact Contact Number
                <input type="text" name="contact_contactNo" required>
            </label>
            <label for="">Picture
                <input type="file" name="picture_file" size="60">
            </label>
            <label for="">Valid ID
                <input type="file" name="validID" size="60">
            </label>

            <label for="">Signature
                <input type="file" name="signature" size="60">
            </label>
            <button type="submit" name="reg_btn">Register Establishment</button>
        </form>
    </div>
</body>
</html>