<?php
$servername = "localhost";
$username = "root"; 
$password = "";  
$database = "productdb"; 

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else{
//     echo "connect sucessful";}
 


// You can now use the $conn variable to perform database operations
function getdata($conn) {
    $sql = "SELECT * FROM `producttb`";
    $result1 = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result1) > 0){
        return $result1;
    }
}


?>
