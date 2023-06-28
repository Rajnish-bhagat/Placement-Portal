<?php
	require 'config.php';
    session_start();
	
	if(!isset($_SESSION['logged_in']))
	{
		header('Location: TPC.html'); // redirecting the user to another link
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Page</title>
	<style>
        		/*body {
			margin: 0;
			padding: 0;
			background: #34495e;
			font-family: sans-serif;
		}*/
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background-image: linear-gradient(to right, #8360c3, #2ebf91);
		}

		.page {
			padding: 8% 0 0;
			margin: auto;
		}

		.form {
			position: relative;
			z-index: 1;
			background-color: rgba(255, 255, 255, 0.7); /* 70% opacity white */
			max-width: 800px;
			margin: 0 auto 100px;
			padding: 45px;
			text-align: center;
			border-radius: 25px;
			box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 5px 20px 0 rgba(0, 0, 0, 0.15);
		}

		.form input[type='number'],
		.form input[type='text'],
		.form input[type="email"],
		.form input[type="password"] {
		font-family: "Roboto", sans-serif;
		outline: 0;
		background: #f2f2f2;
		width: 100%;
		border: 0;
		margin: 0 0 15px;
		padding: 15px;
		box-sizing: border-box;
		font-size: 14px;
		border-radius: 25px;
		}

		.form button[type="submit"] {
			font-family: "Roboto", sans-serif;
			text-transform: uppercase;
			outline: 0;
			background: #27ae60;
			width: 200px;
			border: 0;
			padding: 15px;
			color: #FFFFFF;
			font-size: 14px;
			cursor: pointer;
			border-radius: 25px;
			transition: all 0.3s ease-in-out;
		}
		h1 {
		font-size: 28px;
		font-weight: bold;
		text-align: center;
		margin-bottom: 30px;
		color: #333333;
		text-shadow: 1px 1px 1px #ffffff;
		}
		.form select {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
			font-size: 18px;
		}
		.form button[type="submit"]:hover {
			background: #2ecc71;
		}

		.form .message {
			margin: 15px 0 0;
			color: #b3b3b3;
			font-size: 12px;
		}

		.form .message a {
			color: #27ae60;
			text-decoration: none;
		}

		.form .alert {
			margin-top: 10px;
			color: red;
			font-size: 12px;
			text-align: center;
			display: none;
		}

		.button-container {
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
		}
		.button-container form {
			margin: 20px;
		}
		.button-container .button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			transition: all 0.3s ease-in-out;
		}
		.button-container .button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
    <div class = "page">
		<div class = "form">
			<h1>Student Dashboard</h1>
			<div class="button-container">
				<form method="POST" action="update_placement.html">
					<button type="submit" class="button" name="update">Update Placement</button>
				</form>

				<form method="POST" action="view_students.php">
					<button type="submit" class="button" name="update">View Students</button>
				</form>
                
                <form method="POST" action="Home.php">
					<button type="submit" class="button" name="update">Back</button>
				</form>
				</form>
        </div>
	</div>
</body>
</html>
