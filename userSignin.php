<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign-in</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>User Sign-in</h1>
    <form action="./process/process_user_login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign In">
    </form>
    <p>Don't have an account? <a href="user_signup.php">Sign Up</a></p>
</body>
</html>
<style>/* Existing CSS styles */

/* Additional styling for the sign-in form */
body, h1, form {
    margin: 20px;
    padding: 20px;
}
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input[type="email"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Additional styling for the "Sign Up" link */
p a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

p a:hover {
    text-decoration: underline;
}
</style>