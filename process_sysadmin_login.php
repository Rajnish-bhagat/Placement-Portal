<?php

session_start();
$password = $_POST['password'];

if ($password=="pass") {
	// Password is correct, check if email is verified
		header("Location: admin_terminal.php");
		exit();
	
} else {
	// Password is incorrect, display error message
	echo "<script>alert('Invalid password.')</script>";
	echo "<script>window.location='sysadmin_login.html'</script>";
	exit();
}
?>
