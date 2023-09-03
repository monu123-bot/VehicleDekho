<?php
session_start();
include("../connection.php");
if (!isset($_SESSION['agencyId'])) {
    // If agency is not logged in, redirect to the login page
    header("Location: ../agencySignin.php");
    exit();
}


// Check if the POST request is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $vehicleid = $_GET['vehicleid']; // Get the vehicle ID from the URL
    $model = $_POST['model'];
    $number = $_POST['number'];
    $sittingCapacity = $_POST['sittingCapacity'];
    $rentPerDay = $_POST['rentPerDay'];

    // Update the values in the database
    $sql = "UPDATE vehicle
            SET model = '$model', number = '$number', SittingCapacity = '$sittingCapacity', rentPerDay = '$rentPerDay'
            WHERE VehicleId = '$vehicleid' ";

    if (mysqli_query($conn, $sql)) {
        // Redirect to a success page or display a success message
        header("Location: ../agency_dashboard.php");
        exit();
    } else {
        // Handle the error, e.g., display an error message or redirect to an error page
        header("Location: ../error.php");
        echo "Error updating record: " . mysqli_error($your_connection);
    }

   
}
?>

