<?php
require 'config.php';
session_start();

if(!isset($_SESSION['logged_in']))
{
    header('Location: TPC.html'); // redirecting the user to another link
}

session_start(); // Start the session

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data
    $roll_number = $_POST['roll_number'];
    $company = $_POST['company'];
    $package = $_POST['package'];
    $role = $_POST['role'];
    $offcampus = $_POST['offcampus'];
    $location = $_POST['place_of_work'];

    echo $roll_number.'</br>';
    echo $location.'</br>';;
    echo $role.'</br>';;
    echo $package.'</br>';;

    echo $offcampus.'</br>';;
    echo $company.'</br>';;

    // Only update fields that have changed
    $sql = "UPDATE student_placement SET 
            company = '$company', 
            role = '$role',
            package ='$package', 
            off_campus = '$offcampus',
            place_of_work = '$location'
            WHERE roll_number = '$roll_number'";
    $result = $conn->query($sql);
    
    if ($result) {
        // Success message
        echo '<script type="text/javascript">alert("Placement Details of Student updated successfully!")</script>';
        echo '<script language="javascript">window.location = "http://localhost/miniproject_dbms/Student_Home.php";</script>';
    } else {
        // Error message
        echo "Error: Failed to update profile details.";
    }
    
}
?>
