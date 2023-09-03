<?php
// Start a session to access agency ID
session_start();
if (!isset($_SESSION['agencyId'])) {
    // If agency is not logged in, redirect to the login page
    header("Location: ../agencySignin.php");
    exit();
}

// Get the agency ID from the session
$agencyId = $_SESSION['agencyId'];


include("../connection.php");

// Create a database connection

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get vehicle details from the form
$model = $_POST['model'];
$number = $_POST['number'];
$sittingCapacity = $_POST['sittingCapacity'];
$rentPerDay = $_POST['rentPerDay'];

// Generate VehicleId as a combination of current timestamp and agency ID
$vehicleId = time() . "_" . $agencyId;

// SQL query to insert the new vehicle into the database
$sql = "INSERT INTO vehicle (VehicleId, model, number, SittingCapacity, rentPerDay, agencyId)
        VALUES ('$vehicleId', '$model', '$number', $sittingCapacity, $rentPerDay, '$agencyId')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../agency_dashboard.php");
    echo "New vehicle added successfully!";
} else {
    header("Location: ../error.php");
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
