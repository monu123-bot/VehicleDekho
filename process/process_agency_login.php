<?php


// Create a database connection
include("../connection.php");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get agency input from the form
$uin = $_POST['uin'];
$password = $_POST['password'];

// SQL query to retrieve agency data by UIN
$sql = "SELECT * FROM agencies WHERE UIN = '$uin'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    // Verify the provided password with the hashed password in the database
    if (password_verify($password, $row['password'])) {
        // Password is correct, agency is authenticated
        session_start();
        $_SESSION['agencyId'] = $row['agencyId']; // Store agency ID in session
        $_SESSION['user_name'] = $row['name'];
        header("Location: ../agency_dashboard.php"); // Redirect to agency dashboard
        // exit();
    } else {
        // Password is incorrect
        echo "Invalid password. <a href='../agencySignin.php'>Try again</a>";
    }
} else {
    // Agency not found
    echo "Agency not found. <a href='../agencySignup.php'>Sign Up</a>";
}


?>
