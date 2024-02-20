<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password =  $_POST['password'];

    // Fix the SQL query condition
    $query = "SELECT * FROM `staffdetailtb` WHERE `username` = '$username' AND `password` = '$password'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        // Login failed
        $message = "Username or password is incorrect.";
        echo "<script>alert('$message'); window.location.href = 'login.html';</script>";
        exit();
    }
}
?>
