<!DOCTYPE html>
<head>
    <title>System Admin</title>
    <link rel="stylesheet" href="style.css">
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

    </style>
</head>
<body>
<div class="page">
    <div class="form" >
        <h1>Hello Admin</h1>
        <form method="POST" action="">
            <input type="text" placeholder="Type your sql query" name="query" required />
            <button type="submit" name="submit">Execute</button>
            <p class="message">Done? <a href="sysadmin_logout.php">Logout</a></p>
        </form>
    </div>
</div>
    
</body>
</html>

<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    session_start();
    // Get the MySQL query from the text box
    $query = $_POST['query'];

    $servername = "localhost";
    $username = "root"; 
    $password = "Rajnish@7000";  
    $dbname = "TPC";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection 
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Execute the MySQL query
    $result = mysqli_query($conn, $query);
    if (strpos($query, "SELECT") !== false || strpos($query , "select") !== false) {
         // echo $result;
         $num_fields = mysqli_num_fields($result);

         echo "<table>";
         echo "<tr>";
         for ($i = 0; $i < $num_fields; $i++) {
             $field_name = mysqli_fetch_field_direct($result, $i)->name;
             echo "<th>" . $field_name . "</th>";
         }
         echo "</tr>";
         while ($row = mysqli_fetch_assoc($result)) {
             echo "<tr>";
             foreach ($row as $value) {
                 echo "<td>" . $value . "</td>";
             }
             echo "</tr>";
         }
         echo "</table>";
    } else {
        echo "EXECUTED SUCCESSFULLY";
    }
}
?>

