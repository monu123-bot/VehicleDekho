<?php



// Create a database connection
include("../connection.php");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get agency data from the form

$name = $_POST['name'];
$uin = $_POST['uin'];
$state = $_POST['state'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$country = $_POST['country'];
$type = 'agency';
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$timestamp = time(); // Get current timestamp
$agencyId = "AG" . $timestamp . $uin; // Combine timestamp and UIN to generate agencyId

$sql0 = "Select * from agencies where UIN=$uin";
$result0 = $conn->query($sql0);
if($result0->num_rows === 1){
    echo 'UIN already exists please try with different UIN <a href="agencySignup.php"> back  </a>  ';

   
}
else{
    // SQL query to insert agency data into the database
$sql = "INSERT INTO agencies (agencyId, name, UIN, state, city, pincode, country, type, password)
VALUES ('$agencyId', '$name', '$uin', '$state', '$city', '$pincode', '$country', '$type', '$password')";

if ($conn->query($sql) === TRUE) {
echo "Agency registered successfully!";
header("Location: ../agencySignin.php");
} else {
    header("Location: ../error.php");
echo "Error: " . $sql . "<br>" . $conn->error;
}
}


?>
