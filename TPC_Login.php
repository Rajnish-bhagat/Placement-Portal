<?php
require 'config.php';
session_start();

// Retrieve form data

require 'config.php';

$uname = $_POST['username'];
$password = $_POST['password'];

if ($uname == 'Admin' && $password == 'asdfg')
{
    // Login successful
    $_SESSION['logged_in'] = true;
    echo "Login successful!";
    // Perform actions after successful login, such as redirecting to a new page
    header("Location: Home.php"); // uncomment this line and change the file name to your desired success page
    exit;
} 
else 
{
    // Login failed
    echo "Invalid email or password";
}

$conn->close();
?>
