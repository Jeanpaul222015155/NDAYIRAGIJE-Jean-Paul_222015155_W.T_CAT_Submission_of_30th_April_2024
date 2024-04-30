<?php
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname  = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $gender = $_POST['gend'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $activation_code = $_POST['activation_code'];
    
    $sql = "INSERT INTO user (Firstname, Lastname, Username, Gender, Email, Telephone, Password, Activation_code ) 
    VALUES ('$fname','$lname','$username','$gender','$email','$telephone','$password','$activation_code')";

    if ($connection->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
$connection->close();
?>
