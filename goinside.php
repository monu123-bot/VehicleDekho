<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Car Rental Portal</h1>
        <p>Please select your role:</p>

        <div class="button-container">
            <a href="userSignin.php" class="button">Sign In as User</a>
            <a href="userSignup.php" class="button">Sign Up as User</a>
        </div>

        <div class="button-container">
            <a href="agencySignin.php" class="button">Sign In as Agency</a>
            <a href="agencySignup.php" class="button">Sign Up as Agency</a>
        </div>
    </div>
</body>
</html>
<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin-top:30px;
    margin-left:auto;
    margin-right:auto;
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    color: #333;
}

p {
    font-size: 18px;
    color: #666;
    margin-top: 20px;
}

.button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    background-color: #007BFF;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #0056b3;
}

</style>