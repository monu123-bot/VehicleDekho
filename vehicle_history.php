<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicle History</title>
    <!-- Include any CSS styles or libraries you want to use for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 


</head>
<body>



    <?php
 
if (!isset($_SESSION['agencyId'])) {
    // If agency is not logged in, redirect to the login page
    header("Location: agencySignin.php");
    exit();
}

include("navbar.php");

    include("connection.php");

    $vehicleid = $_GET['vehicleid'];

  
    // SQL query to retrieve available cars
    
    $sql = "SELECT * FROM booking_log,vehicle where booking_log.vehicleid = '$vehicleid' and booking_log.vehicleid = vehicle.VehicleId " ;

    // Execute the query
    $resultVehicles = $conn->query($sql);
    ?>
   
    <div class="vehicle-list" >
        <?php
        if ($resultVehicles->num_rows > 0) {
            ?>
            <h1>History for vehicle id <?php echo $vehicleid ?> </h1>
        <?php    // Display the list of vehicles 
           
            echo "<table>";
            echo "<tr><th>User ID</th><th>Model</th><th>Number</th><th>Sitting Capacity</th><th>Rent per Day</th><th>Start Date</th><th>End Date</th><th>Booking Date</th></tr>";

            while ($row = $resultVehicles->fetch_assoc()) {
                
                $startDate = date('Y-m-d',intval($row['starttime']));
                $endDate = date('Y-m-d',intval($row['endtime']));
                $bookingDate =  date('Y-m-d', intval($row['bookingTime'])) ;
                  echo "<tr>";
                if($row['starttime']<$row['endtime']){
                    
                    echo "<td>" . $row['userid'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['SittingCapacity'] . "</td>";
                echo "<td>" . $row['rentPerDay'] . "</td>";
                echo "<td>" . $startDate . "</td>";
                echo "<td>" . $endDate . "</td>";
                echo "<td>" . $bookingDate . "</td>";
                    
                    
                }
                else{
                    
                    echo "No history available for this vehicle";
                }
                
                     

                  
                
                


                
                echo "</tr>";


                
                
            }

            echo "</table>";
        } else {

            ?>
            <div class="empty-div"  >
            <h4>No history for this vehicle 😑</h4>
             </div>
           
      <?php  }
      
        ?>
           
         </div>
      
       
      

      


</body>
</html>
<style>/* Reset some default styles */
.vehicle-list{
    text-align:center;
}
.empty-div{
    width:fit-content;
    margin-left:auto;
    margin-right:auto;
    margin-top:50px;
}
body, h1, p, ul, li {
    margin: 20px;
    padding: 20px;
}

/* Apply a background color and set font styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin-left:auto;
    margin-right:auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align:center;
}

h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

p {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

/* Style navigation menu or other elements as needed */
ul {
    list-style: none;
}

li {
    display: inline;
    margin-right: 20px;
}

a {
    text-decoration: none;
    color: #007BFF;
}

a:hover {
    text-decoration: underline;
    color: #0056b3;
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
/* Base button styles */
button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}


a{
    text-decoration:None
}
/* Hover effect */
button:hover {
    background-color: black;
    color:white
}


</style>
