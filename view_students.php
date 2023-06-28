<?php
require 'config.php';
session_start();

if(!isset($_SESSION['logged_in']))
{
	header('Location: TPC.html'); // redirecting the user to another link
}


$currentYear = date('Y');
$email = $_SESSION['sess_user_email'];
$id = $_SESSION['sess_user_id'];
$role = $_SESSION['sess_user_role'];
$_SESSION['selectedYear'] = $currentYear;


$result = mysqli_query($conn, "select * from companies where id = '$id'"); 
$row = mysqli_fetch_array($result);  // row gets stored as an array
$Fname = $row["name"];


$prefix = 'year_';
$tableName = $prefix . $_SESSION['selectedYear']; // concatenate prefix and date to create table name

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style>
		/* Custom CSS styles */
		body {
			/* background-color: #f5f5f5; */
			background-image: linear-gradient(to right, #8360c3, #2ebf91);		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 20px;
			
			/* background-color: #FAF0E6; */
			background-color: #F2E6FF;
			background-color: rgba(255, 255, 255, 0.5);

			box-shadow: 0 0 5px rgba(0,0,0,0.3);
		}

		.heading {
			margin-bottom: 20px;
			text-align: center;
		}

		.top {
			margin-top: 20px;
			text-align: center;
		}

		.top a {
			display: inline-block;
			margin: 0 10px;
			padding: 10px 20px;
			background-color: #333;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
		}

		.top a:hover {
			background-color: #444;
		}


		form button {
			font-size: 20px;
			padding: 15px 20px;
			border: none;
			border-radius: 5px;
			background-color: #e60000;
			color: #ffffff;
			cursor: pointer;
			box-shadow: 2px 2px 2px #cccccc;
			transition: background-color 0.3s ease-in-out;
		}

		form button:hover {
			background-color: #ff1a1a;
		}

		form button:focus {
			outline: none;
		}

		.scroll-view {
			max-height: 400px;
			overflow-y: scroll;
			margin-bottom: 20px;
		}

		.card {
			margin: 20px 0;
			padding: 20px;
			background-color: #FAF0E6;
			box-shadow: 0 0 5px rgba(0,0,0,0.1);
		}
		.card h2 {
			margin-top: 0;
		}


		.student-list {
		margin: 0;
		padding: 0;
		list-style: none;
		}

		.student-item {
		padding: 10px;
		border-bottom: 1px solid #ccc;
		}

		.student-name {
		margin: 0;
		font-size: 18px;
		font-weight: bold;
		}

		.student-info {
		margin: 5px 0 0 0;
		font-size: 14px;
		} 

	</style>
</head>


<body>
    <div class="container">
        <div class="heading">
            <h1> <?php echo "Student List"?> </h1>
        </div>
        <div class="top">
          
        </div>

		<!-- <h3 style="text-align: center;"> <?php echo "Eligible Students according to the current Criteria and Job Role are :"; ?> </h3> -->

		<div class="scroll-view">
  			<ul class="student-list">
    		<?php
      		// Query the database to get a list of students

			$currentYear = date('Y');
			$batch_year = $currentYear -3;
			
			$queryx = "SELECT *
			FROM student_details 
			WHERE batch_year = '$batch_year'";
				
			$resultx = mysqli_query($conn, $queryx);
      
			if (mysqli_num_rows($resultx) > 0) 
			{
				echo '<div class="scroll-view">';
				while($rows = mysqli_fetch_assoc($resultx)) 
				{
					echo '<div class="card">';
					echo '<h2> Roll no: ' . $rows['roll_number'] . '</h2>';
					echo '<h4 class="student-name">CPI: '.$rows['cpi'].' &nbsp;&nbsp;&nbsp;&nbsp; Specialization: '.$rows['specialization'].' &nbsp;&nbsp;&nbsp;&nbsp; Backlog: '.$rows['back'].'&nbsp;&nbsp;&nbsp;&nbsp;  <a href="'.$rows['resume_link'].'">Resume</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="'.$rows['transcript_link'].'">Transcript</a> </h4>';
					echo '</div>';
				}
				echo '</div>';
			}

    		?>
  			</ul>
		</div>

    </div>	
</body>
</html>

