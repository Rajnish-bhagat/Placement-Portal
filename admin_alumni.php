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

		.scroll-view {
			max-height: 700px;
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

		.form button[type="submit"] {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #27ae60;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            cursor: pointer;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
        }

		.button-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-top: -10px; /* Adjust this value to move the button upwards or downwards */
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
    <div class="container">
        <div class="heading">
            <h1> <?php echo "Alumni List"?> </h1>
        </div>
        <div class="top">
          
        </div>


		<div class="scroll-view">
  			<ul class="student-list">
    		<?php
      		// Query the database to get a list of students

			$currentYear = date('Y');
			$batch_year = $currentYear -3;

			
			$queryx = "SELECT *
            FROM alumni_current_details";
           
            $resultx = mysqli_query($conn, $queryx);
      
			if (mysqli_num_rows($resultx) > 0) 
			{
				echo '<div class="scroll-view">';
				while($rows = mysqli_fetch_assoc($resultx)) 
				{
					echo '<div class="card">';
					echo '<h2> Roll no: ' . $rows['roll_number'] . '</h2>';
                    echo '<h4 class="student-name">Company: '.$rows['company'].' &nbsp;&nbsp;&nbsp;&nbsp; CTC: '.$rows['ctc'].' &nbsp;&nbsp;&nbsp;&nbsp; Job Role: '.$rows['role_'].'</h4>';
                    echo '<h4 class="student-name">Position: '.$rows['position'].' &nbsp;&nbsp;&nbsp;&nbsp; Place of Work: '.$rows['place_of_work'].' &nbsp;&nbsp;&nbsp;&nbsp; Working Tenure: '.$rows['working_tenure'].' &nbsp;&nbsp;&nbsp;&nbsp; Experience: '.$rows['previous_experience'].'</h4>';
                    echo '</div>';
				}
				echo '</div>';
			}

    		?>
  			</ul>
		</div>
		<div class="button-container">
            <form action="Home.php" method="post">
                <button type="submit" class="button">Back</button>
            </form>
        </div>
    </div>	
</body>
</html>

