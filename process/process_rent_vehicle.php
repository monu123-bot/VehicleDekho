<?php


// Include your database connection here
include("../connection.php");

// Check if the form is submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $userid = $_POST['userId'];
    $vehicleid = $_POST['vehicleId'];
    $agencyid = $_POST['agencyId'];
    $rentDays = $_POST['rentDays'];
    $startDate = $_POST['startDate'];

    $starttimestamp = strtotime($startDate);
    $endtimestamp = $starttimestamp+$rentDays*86400;
   
   

    echo $userid;
    echo $vehicleid;
    echo $agencyid;
    echo $rentDays;
    // Calculate the start time (current timestamp)
    $startTime = time();

    // Calculate the end time based on start time and rent days
    $numberOfSecondsInOneDay = 86400; // 60 seconds * 60 minutes * 24 hours
    $endTime = $startTime + ($rentDays * $numberOfSecondsInOneDay);

    // Include your database connection and perform the database operations
    // Example using mysqli:

    // 1. Insert into booking log table
    $sql = "INSERT INTO booking_log VALUES ('$vehicleid','$agencyid','$userid
    ','$starttimestamp','$endtimestamp','$startTime')";

    $result = mysqli_query($conn,$sql);



    

    // 2. Update the 'vehicle' table to set 'bookedTill' to 'endTime'
    $updateSql = "UPDATE vehicle SET bookedTill = '$endTime' WHERE VehicleId = '$vehicleid'";
    $updateResult = mysqli_query($conn, $updateSql);

    //3. Update the vehicle_user table
    $sql2 = "INSERT INTO user_vehicle (userid,vehicleid) VALUES ( '$userid','$vehicleid' )";
    $result2 = mysqli_query($conn, $sql2);
    
    // Check if the database operations were successful
    if ($result && $updateResult && $result2) {
        // Rental and update successful
        header("Location: ../final.php");
        exit();
        
        

    } else {
        // Error handling if the database operations fail
        header("Location: ../error.php");
        echo "Error: " . mysqli_error($conn);
    }
    
  
} else {
    // Redirect to an error page if the form was not submitted via POST
    header("Location: ../error.php");
    exit();
}
?>
