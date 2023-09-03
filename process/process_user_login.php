<?php
// Create a database connection

include("../connection.php");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}

// Get user inputs from the form
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to retrieve user data by email
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, user is authenticated
        
      
         
        @session_start();
    $_SESSION['role'] = 'user';
  $_SESSION['user_id'] = $row['userID']; // Store user ID in session
        $_SESSION['user_name'] = strval($row['fName']) . strval($row['lName']);
 header("Location: ../home.php"); // Redirect to user dashboard



        
      
       
    
    } else {
        // Password is incorrect
        echo "Invalid password. <a href='../userSignin.php'>Try again</a>";
    }
} else {
    // User not found
    echo "User not found. <a href='../userSignup.php'>Sign Up</a>";
}

?>
