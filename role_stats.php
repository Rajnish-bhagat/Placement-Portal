<?php
require 'config.php';
session_start();

if(!isset($_SESSION['logged_in']))
{
    header('Location: TPC.html'); // redirecting the user to another link
}

$currentYear = date('Y');
$prefix = 'year_';
$tableName = $prefix . $currentYear; // concatenate prefix and date to create table name

$sql = "SELECT Role, COUNT(*) AS frequency FROM $tableName GROUP BY Role";

// Execute the query
$result = $conn->query($sql);

// Create two arrays to store the labels and data for the chart
$labels = [];
$data = [];

// Loop through the query result and populate the arrays
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row["Role"];
        $data[] = $row["frequency"];
    }
}

// Close the database connection
$conn->close();

// Encode the labels and data arrays as JSON
$labels_json = json_encode($labels);
$data_json = json_encode($data);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Role Frequency</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        canvas {
            height: 90%;
            width: 90%;
            margin: auto;
        }
    </style>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script>
        // Parse the JSON-encoded labels and data arrays
        var labels = <?php echo $labels_json; ?>;
        var data = <?php echo $data_json; ?>;

        // Create a new Chart object with the data
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Job Role Frequency',
                    data: data,
                    backgroundColor: '#2196F3',
                    borderColor: '#2196F3',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
