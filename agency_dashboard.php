<?php
// Start a session to access agency ID and other session data
session_start();

include("connection.php");

if (!isset($_SESSION['agencyId'])) {
    // If agency is not logged in, redirect to the login page
    header("Location: agencySignin.php");
    exit();
}

// Get the agency ID from the session
$agencyId = $_SESSION['agencyId'];


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve agency data by agency ID
$sqlAgency = "SELECT * FROM agencies WHERE agencyId = '$agencyId'";
$resultAgency = $conn->query($sqlAgency);
$agencyData = $resultAgency->fetch_assoc();

$currentTimestamp = time();
// SQL query to retrieve vehicles posted by this agency
$sqlBookedVehicles = "select *,(bookedTill-$currentTimestamp)/86400 as ftime from vehicle v, users u, user_vehicle uv where v.VehicleId = uv.vehicleid and u.userID = uv.userid and v.agencyId = '$agencyId' and v.bookedTill>$currentTimestamp order by ftime asc   "  ;
$sqlAvalVehicles = "SELECT * FROM vehicle WHERE agencyId = '$agencyId' and vehicle.bookedTill<$currentTimestamp  ";
$resultBookedVehicles = $conn->query($sqlBookedVehicles);
$resultAvalVehicles = $conn->query($sqlAvalVehicles);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency Dashboard</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</head>
<body>
   
   <?php include("navbar.php"); ?>

    <div class="container">
        <h1>Agency Dashboard</h1>

        <!-- Display agency information -->
        <div class="agency-info">
            <h2>Agency Information</h2>
            <hr>
            <p><strong>Agency ID:</strong> <?php echo $agencyData['agencyId']; ?></p>
            <p><strong>Name:</strong> <?php echo $agencyData['name']; ?></p>
            <p><strong>UIN:</strong> <?php echo $agencyData['UIN']; ?></p>
            <p><strong>State:</strong> <?php echo $agencyData['state']; ?></p>
            <p><strong>City:</strong> <?php echo $agencyData['city']; ?></p>
            <!-- Add more agency details here -->
        </div>


                
                <div class='modal fade' id='vid' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                      
                      <div class='agency-info'>
                      <form action="./process/process_add_vehicle.php" method="POST">
        <label for='model'>Model:</label>
        <input type='text' id='model'    name='model' required><br><br>

        <label for='number'>Number:</label>
        <input type='text' id='number'  name='number' required><br><br>

        <label for='sittingCapacity'>Sitting Capacity:</label>
        <input type='number' id='sittingCapacity'  name='sittingCapacity' required><br><br>

        <label for='rentPerDay'>Rent per Day:</label>
        <input type='number' id='rentPerDay'  name='rentPerDay' required><br><br>

        <!-- Hidden input field to store the agency ID -->
        <input type='hidden' name='agencyId' value='<?php echo $agencyId ?>'>

        <input type='submit' value='Add Vehicle'>
    </form>
</div>


                      </div>
                      
                    </div>
                  </div>
                </div>



               
     
<div class="vehicle-list" >
    
        <?php
        if ($resultBookedVehicles->num_rows > 0) {
            // Display the list of vehicles posted by the agency
            echo "<h2>Booked vehicles</h2>";

            ?>
            
                
            <?php
            echo "<table>";
            echo "<tr><th>Vehicle ID</th><th>Model</th><th>Number</th><th>Sitting Capacity</th><th>Rent per Day</th><th>Will be available after</th><th>Status</th><th>Edit</th><th>Rantee</th><th>History</th></tr>";

            while ($row = $resultBookedVehicles->fetch_assoc()) {
                $vid = $row['VehicleId'];
                $model = $row['model'];
                $number = $row['number'];
                $scp =  $row['SittingCapacity'];
                $rpd = $row['rentPerDay'];
                $ranteeName = $row['fName'];
                $email = $row['email'];
                $phone = $row['phone'];
                $ftime = $row['ftime'];
                $atime = 0;
                $ttime =$ftime;
                if ($ftime<0){
                    $ftime = 'Available';
                }
                else{
                    if($ftime<1){
                        $atime = $ftime*24;
                    }
                    if ($atime==0){
                        $ftime = strval($ftime) . ' days'; 
                    }
                    else{
                        $ftime = strval($atime) . ' hours';
                    }
                }
                
                
                echo "<tr>";
                echo "<td>" . $row['VehicleId'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['SittingCapacity'] . "</td>";
                echo "<td>" . $row['rentPerDay'] . "</td>";
                echo "<td>" . $ftime . "</td>";
                $ctime = time();
                if (intval($row['bookedTill'])<$ctime){
                    echo "<td>" . "Available" . "</td>";
                }
                else{
                    echo "<td>" . "Booked" . "</td>";
                }
                echo "<td>" . "
                

               
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#$vid'>
                  Edit
                </button>
                
                
                <div class='modal fade' id='$vid' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                      
                      <div class='agency-info'>
    <form action='./process/process_edit_vehicle.php?vehicleid=$vid' method='POST'>
        <label for='model'>Model:</label>
        <input type='text' id='model'  value = '$model'  name='model' required><br><br>

        <label for='number'>Number:</label>
        <input type='text' id='number' value='$number' name='number' required><br><br>

        <label for='sittingCapacity'>Sitting Capacity:</label>
        <input type='number' id='sittingCapacity' value='$scp' name='sittingCapacity' required><br><br>

        <label for='rentPerDay'>Rent per Day:</label>
        <input type='number' id='rentPerDay' value='$rpd' name='rentPerDay' required><br><br>

        <!-- Hidden input field to store the agency ID -->
        <input type='hidden' name='agencyId' value='$agencyId'>

        <input type='submit' value='Save Changes'>
    </form>
</div>


                      </div>
                      
                    </div>
                  </div>
                </div>
                


                " . "</td>";

                echo "<td>" . "
                

               
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#$vid+1'>
                  Details
                </button>
                
                
                <div class='modal fade' id='$vid+1' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        
                      <div class='agency-info'>
                        Name:  $ranteeName
                        <br>
                        Email:  $email
                        <br>
                        Phone: +91 $phone

</div>


                      </div>
                      
                    </div>
                  </div>
                </div>
                


                " . "</td>";
                echo "<td>" . "  <a  href='vehicle_history.php?vehicleid=$vid'   > Check History </a>" . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No Booked vehicles.";
        }
        ?>
       </div>

       <div class="vehicle-list" >
       <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#vid'>
                  Add Vehicle
                </button>
    <?php
    if ($resultAvalVehicles->num_rows > 0) {
        // Display the list of vehicles posted by the agency
        echo "<h2>Available vehicles</h2>";

        ?>
        
            
        <?php
        echo "<table>";
        echo "<tr><th>Vehicle ID</th><th>Model</th><th>Number</th><th>Sitting Capacity</th><th>Rent per Day</th><th>History</th></tr>";

        while ($row = $resultAvalVehicles->fetch_assoc()) {
            $vid = $row['VehicleId'];
            $model = $row['model'];
            $number = $row['number'];
            $scp =  $row['SittingCapacity'];
            $rpd = $row['rentPerDay'];
            
            
            
            echo "<tr>";
            echo "<td>" . $row['VehicleId'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['number'] . "</td>";
            echo "<td>" . $row['SittingCapacity'] . "</td>";
            echo "<td>" . $row['rentPerDay'] . "</td>";
            echo "<td>" . "  <a  href='vehicle_history.php?vehicleid=$vid'   > Check History </a>" . "</td>";
            
           
            

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No Available vehicle";
    }
    ?>
   </div>

    </div>


</body>
</html>
<style>/* Reset some default styles */
body, h1, h2, table, th, td {
    margin: 20px;
    padding: 20px;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

.container {
    max-width: fit-content;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

p {
    margin-bottom: 10px;
}

table {
    width: 95%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007BFF;
    color: #fff;
}




/* Agency Information section */
.agency-info {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

.agency-info h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
}

.agency-info p {
    margin-bottom: 8px;
}

/* Vehicle list table */
table {
    margin-bottom: 30px;
}
h2 {
    font-size: 20px;
    color: #333;
    margin-top: 30px;
    margin-bottom: 10px;
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form input[type="submit"],
form select {
    width: 90%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

form input[type="hidden"] {
    display: none; /* Hide the agencyId input */
}

/* Customize the submit button */
form input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form input[type="submit"]:hover {
    background-color: #0056b3;
}
.vehicle-list{
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

</style>