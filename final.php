<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Car Rental Request Confirmation</title>
    <!-- Include any CSS styles or libraries for styling -->
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 
</head>
<body>

    <?php include("navbar.php"); ?>
    <div class="container">
        <h1>Car Rental Request Registered</h1>
        <p>Dear User,</p>
        <p>Your car rental request has been registered successfully. Our team will reach out to you within 2 hours for further processing.</p>
        <p>Thank you for choosing our services.</p>

        <a href="home.php">Book more cars </a>
    </div>
</body>
</html>
<style>/* Reset some default styles */
body, h1, p {
    margin: 0;
    padding: 0;
}

/* Apply a background color and set font styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
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

p {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

</style>