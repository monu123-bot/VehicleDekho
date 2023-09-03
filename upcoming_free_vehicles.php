<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Available Free Vehicles</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 
</head>
<body>
    <?php include("navbar.php");
    
    ?>

    <div class="container">
        <h1>Upcoming Available Free Vehicles</h1>

        <?php
        // Replace these database connection details with your actual database credentials
        include("connection.php");

        // Calculate the current timestamp
        $currentTimestamp = time();

        // SQL query to retrieve upcoming available free vehicles
        $sql = "SELECT *, (bookedTill-$currentTimestamp)/86400 as ftime FROM vehicle WHERE bookedTill > $currentTimestamp order by ftime asc";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data in an HTML table
            echo '<table border="1">
                <tr>
                    <th>Vehicle Model</th>
                    <th>Vehicle Number</th>
                    <th>Seating Capacity</th>
                    <th>Rent per Day</th>
                    <th>Will be free in</th>

                </tr>';

            while ($row = $result->fetch_assoc()) {
              
                $ftime = $row['ftime'];
                $atime = 0;
                if($ftime<1){
                    $atime = $ftime*24;
                }
                if ($atime==0){
                    $ftime = strval($ftime) . ' days'; 
                }
                else{
                    $ftime = strval($atime) . ' hours';
                }
                echo '<tr>
                    <td>' . $row['model'] . '</td>
                    <td>' . $row['number'] . '</td>
                    <td>' . $row['SittingCapacity'] . '</td>
                    <td>' . $row['rentPerDay'] . '</td>
                    <td>' . $ftime . '</td>
                </tr>';
            }

            echo '</table>';
        } else {
            echo "No upcoming available free vehicles.";
        }

        
        ?>

    </div>
</body>
</html>
<style>/* Reset some default styles */
body, h1, table {
    margin:20px;
    padding: 20px;
}

/* Apply a background color and set font styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 90%px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007BFF;
    color: #fff;
}


</style>