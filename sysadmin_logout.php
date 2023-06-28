<?php
session_start();

session_destroy();
header("Location: index.php"); // redirect to main home page after logout
exit();
?>
