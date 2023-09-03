<?php

include("../connection.php");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user inputs from the form
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$createdAt = $_POST['createdAt'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

$sql0 = "Select * from users where phone='$phone' or email='$email' ";
$result0 = $conn->query($sql0);
if($result0->num_rows==0){
// SQL query to insert user data into the database
$sql = "INSERT INTO users ( userID, fName, lName, email, gender, phone, createdAt,type, password)
        VALUES ( '$phone',  '$fName', '$lName', '$email', '$gender', '$phone', '$createdAt','user', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully!";
    header("Location: ../userSignin.php");
} else {
    header("Location: ../error.php");
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else{
    echo "User with this email or phone already exists <a href='userSignup.php'> try with another email or phone  </a>  ";
}


?>