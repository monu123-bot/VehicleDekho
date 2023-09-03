<?php 
@session_start();
                   
                
                ?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Cars for Rent</title>
    <!-- Include any CSS styles or libraries you want to use for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 


</head>
<body>



    <?php

include("navbar.php");

    include("connection.php");

  
    // SQL query to retrieve available cars
    $ctime = time();
    $sql = "SELECT * FROM vehicle,agencies where vehicle.agencyId=agencies.agencyId and vehicle.bookedTill<$ctime   " ;

    // Execute the query
    $resultVehicles = $conn->query($sql);
    ?>
   
    <div class="vehicle-list" >
        <?php
        if ($resultVehicles->num_rows > 0) {
            ?>
            <h1>Available Cars for Rent</h1>
        <?php    // Display the list of vehicles 
           
            echo "<table>";
            echo "<tr><th>Posted By</th><th>Model</th><th>Number</th><th>Sitting Capacity</th><th>Rent per Day</th><th>Status</th><th>Rent Vehicle</th></tr>";

            while ($row = $resultVehicles->fetch_assoc()) {
                
                
                     

                    echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['SittingCapacity'] . "</td>";
                echo "<td>" . $row['rentPerDay'] . "</td>";
                echo "<td>" . "Available" . "</td>";
                $agencyid = $row['agencyId'];
                $vehicleid = $row['VehicleId'];
                $agencyname = $row['name'];
                $model = $row['model'];


                
                
                
                if (isset($_SESSION['user_name'])){
                    if ($_SESSION['role']==='user'){
                        
                         $userid = $_SESSION['user_id'];
                    echo  "<td>" . "<a  href='rent_vehicle.php?agencyid=$agencyid&vehicleid=$vehicleid&userid=$userid&agencyname=$agencyname&model=$model'   > Rent vehicle </a>" . "</td>";
                        
                    }
                    else{
                        echo "<td>" . '<button  disabled > <a href="#" > Not allowed </a> </button>' . "</td>";
                    }
                    
                   
                }
                else{
                    echo "<td>" . '<button  disabled > <a href="userSignin.php" > Login </a> </button>' . "</td>";
                }


                
                echo "</tr>";


                
                
            }

            echo "</table>";
        } else {

            ?>
            <div class="empty-div"  >
            <h4>Oops.. 😣 All vehicles are booked.</h4>
             </div>
           
      <?php  }
      
        ?>
        <small> <a href="upcoming_free_vehicles.php"  > You can query the system to retrieve information about vehicles that will become available for booking in the upcoming days 👌. </a> </small>
           
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
