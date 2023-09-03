<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to a login page or any other appropriate page
header("Location: home.php");
exit();
?>
