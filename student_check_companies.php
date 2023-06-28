<?php

require 'config.php';
session_start();
$roll_number = $_SESSION['roll_number'];


// fetch data from year_2023 table
// fetch data from companies table
$sql = "SELECT * FROM companies";
$result_comp = mysqli_query($conn, $sql);

// create an empty array to store eligible companies
$eligible_companies = array();

// loop through the companies table to find eligible companies
while ($row_comp = mysqli_fetch_assoc($result_comp)) {
  $company_name = $row_comp['name'];
  $comp_idd = $row_comp['id'];
  // loop through the year_2023 table data
  $sql = "SELECT * FROM year_2023";
  $result_year = mysqli_query($conn, $sql);
  
  while ($row = mysqli_fetch_assoc($result_year)) {
    $company_id = $row['id'];
    $back = $row['Back'];
    $threshold_marks = $row['ThresholdMarks'];
    $salary_package = $row['SalaryPackage'];
    $role = $row['Role'];
    $interview_mode = $row['InterviewMode'];
    $req_since = $row['RecruitingSince'];

    // check if the student is eligible based on criteria
    $sql = "SELECT student_details.cpi, student_details.back, student_placement.package FROM student_details JOIN student_placement ON student_details.roll_number = student_placement.roll_number WHERE student_details.roll_number='$roll_number'";
    $result_stu = mysqli_query($conn, $sql);
    $row_stu = mysqli_fetch_assoc($result_stu);
    $cpi = $row_stu['cpi'];
    $package = $row_stu['package'];
    $back_status = $row_stu['back'];

    // check if the company is eligible based on criteria
    if ($cpi >= $threshold_marks && $package <= $salary_package && ($back == 'yes' || $back_status == 'no') && $comp_idd==$company_id) {
      $eligible_companies[] = array(
        'company' => $company_name,
        'role' => $role,
        'package' => $salary_package,
        'interview_mode' => $interview_mode,
        'req_since' => $req_since,
        'company_id' => $row_comp['id'],
      );
    }
  }
}

// Now $eligible_companies array should contain all the eligible companies

?>
<!DOCTYPE html>
<html>
<head>
  <title>Available Companies</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
  

  table {
  width: 800px;
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.1);
  background-color: #f8f8f8;
  margin: auto;
  border-radius: 10px;
}

th,
td {
  padding: 15px;
  color: #333;
  text-align: center;
}

th {
  background-color: #55608f;
  color: #fff;
}

tbody tr:hover {
  background-color: #f2f2f2;
}

tbody td {
  position: relative;
}

tbody td:hover:before {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  top: -9999px;
  bottom: -9999px;
  background-color: rgba(0, 0, 0, 0.05);
  z-index: -1;
}

button {
  background-color: #4CAF50;
  border: none;
  color: #FFF;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}


h1 {
  color: white;
}

</style>

</head>
<body>
  <header>
  </header>
   <!-- <div class="form"> -->
  
  <!-- </div> -->
  <div class="page">
  
  <h1 color = "white">Available Companies</h1>
       
     
     <!-- <div class="container"> -->
    <?php
      if (count($eligible_companies) > 0) {
          echo "<table><thead><tr><th>Company Name</th><th>Role</th><th>Salary Offered</th><th>Interview Mode</th><th>Recuriting Since</th><th>Apply</th></tr></thead>";
          echo "<tbody>";
          foreach ($eligible_companies as $company){
            echo '<tr><td>' . $company["company"] . '</td><td>' . $company["role"] . '</td><td>' . $company["package"] . '</td><td>' . $company["interview_mode"] . '</td><td>' . $company["req_since"] . '</td><td><button><a href="apply.php?company_id=' . $company["company_id"] . '&role=' . $company["role"] . '">Apply</button></td></tr>';
        }
        echo "</tbody></table>";
      } else {
        echo "<p>No available companies at the moment.</p>";
      }
      mysqli_close($conn);
    ?>
  <!-- </div> -->
  </div>
</body>
</html>
