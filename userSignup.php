<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign-up</title>
</head>
<body>
    <h1>User Sign-up</h1>
    <form action="./process/process_user_signup.php" method="POST">
        <label for="fName">First Name:</label>
        <input type="text" id="fName" name="fName" required><br><br>

        <label for="lName">Last Name:</label>
        <input type="text" id="lName" name="lName" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="createdAt">Date of Registration:</label>
        <input type="date" id="createdAt" name="createdAt" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign Up">
    </form>
  

</body>
</html>
<style>

    /* Reset some default styles */
body, h1, form {
    margin: 20px;
    padding: 20px;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input[type="text"],
form input[type="email"],
form select,
form input[type="tel"],
form input[type="date"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

form select {
    height: 40px;
}

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

/* Additional styling for links */
a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

</style>
