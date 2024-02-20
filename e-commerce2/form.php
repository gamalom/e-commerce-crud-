<?php

include 'connection.php';

//print_r ($_POST);


if (isset($_POST)) {
    

    $firstName = $_POST['fname'];
    $middleName = $_POST['mname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];

     $query = "INSERT INTO `staffdetailtb`(`first_name`, `middle_name`, `last_name`, `email`, `username`, `password`, `gender`)
     VALUES ('$firstName', '$middleName', '$lastName', '$email', '$username', '$password', '$gender')";
     
     $result = mysqli_query($conn, $query);
    }else{
        die("Error: " . mysqli_error($conn));
    }
    header('Location: login.html');
    exit;
    
?>