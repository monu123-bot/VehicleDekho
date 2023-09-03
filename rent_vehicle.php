<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Rent Vehicle</title>
    <!-- Include any CSS styles or libraries for styling -->
    <link rel="stylesheet" href="your_styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 
</head>
<body>
   <div class="container" >

   <h2>Confirmation Slip</h2>

   <hr>

    <?php
    // Get parameters from GET request
    if (isset($_GET['userid']) && isset($_GET['agencyid']) && isset($_GET['vehicleid']) && isset($_GET['agencyname']) && isset($_GET['model']) ){
        
        $userid = $_GET['userid'];
    $agencyid = $_GET['agencyid'];
    $vehicleid = $_GET['vehicleid'];
    $agencyname = $_GET['agencyname'];
    $model = $_GET['model'];
        
    }
    else{
        echo "you can not accesss this page...";
        exit();
    }
    
    

    
 
    ?>

    <!-- Rental form with dropdown select -->
    <form action="./process/process_rent_vehicle.php" method="POST">

    

    <div  class="hidden" >
    <label for="userid">User Id:</label>
    <input type="text" class="inp" id="userid" name="userId" value='<?php echo $userid ?>' required  >

        
        <label for="agencyid">Agency Id:</label>
        <input type="text" class="inp" id = "agencyid" name="agencyId"  value='<?php echo $agencyid ?>' required >


        <label for="vehicleid">Vehicle Id:</label>
        <input type="text" class="inp" name="vehicleId" id = "vehicleid"  value='<?php echo $vehicleid ?>' required>

    </div>
    <label for="startdate">Start Date:</label>
        <input type="date" class="inp" name="startDate" id = "startdate"   required>

        <label for="rentdays">Select the number of days to rent:</label>
        <select id="rentdays" name="rentDays" required>


        <?php
          for ($i=1; $i <= 10; $i++) { 
          echo  "<option value=$i>$i day</option>";
          
          }
        ?>
            <!-- Add more options as needed -->
        </select>
        

        <button type="submit">Send Request</button>
    </form>

    </div>
</body>
</html>
<style>/* Reset some default styles */


/* Apply a background color and set font styles */
.hidden {
    display: none;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin-top: 30px;
    margin-left: auto;
    margin-right: auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

p {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

select,
input[type="text"],
button {
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    margin: 5px 0;
}

select:hover,
button:hover {
    cursor: pointer;
    color: black;
}

button {
    background-color: #007BFF;
    color: #fff;
    transition: background-color 0.3s, color 0.3s;
}

input {
    width: 400px;
}

/* Add more specific styles for your page elements */
</style>
