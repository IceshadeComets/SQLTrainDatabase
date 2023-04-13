<head>
  <link rel="stylesheet" href="style.css">
</head>
<?php
//Variables to connect to the database
$host = "localhost";
$username ="root";
$password = "";
$database = "471project";

// Create a database instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Inspection Report</title>
</head>

<body bgcolor="FBB917">
<?php
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>Generate Inspection Report</h1>
<form action='generatereportinsp.php' method="POST">
    <input type='submit' name= 'freport' id="freport" value="Generate Report" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["freport"])) {

    echo "<h2><b>List of Safety Inspectors</h2></b>";
    $sqltraubs = "SELECT * FROM Employee JOIN safetyinspector ON safetyinspector.essn = Employee.ssn";
    $result = mysqli_query($mysqli, $sqltraubs);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>InspectorSSN</th><th>CEOSSN</th><th>FirstName</th><th>MiddleName</th><th>LastName</th><th>Salary</th><th>Sex</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row["SSN"] . "</td><td>" . $row["CEOSSN"] . "</td><td>" .  $row["FirstName"] . "</td><td>" . $row["MiddleName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["Salary"] . "</td><td>" . $row["Sex"] . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No results found.";
      }

    echo "<h2><b>List of the 5 most Recently Inspected Trains</h2></b>";

    $sqltraubs = "SELECT * FROM Train ORDER BY last_inspected DESC LIMIT 5";
    $result = mysqli_query($mysqli, $sqltraubs);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>TrainID</th><th>InspectorSSN</th><th>BranchID</th><th>LocomotiveType</th><th>last_inspected</th><th>inspection_status</th><th>cost</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row["TrainID"] . "</td><td>" . $row["InspectorSSN"] . "</td><td>" . $row["BranchID"] . "</td><td>" . $row["LocomotiveType"] . "</td><td>" . $row["last_inspected"] . "</td><td>" . $row["inspection_status"] . "</td><td>" . $row["cost"] . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No results found.";
      }
      

    echo "<h2><b>List of the 5 Furthest Inspected Trains</h2></b>";
    $sqltraubs = "SELECT * FROM Train WHERE last_inspected IS NOT NULL ORDER BY DATEDIFF(NOW(), last_inspected) DESC LIMIT 5";
    $result = mysqli_query($mysqli, $sqltraubs);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>TrainID</th><th>InspectorSSN</th><th>BranchID</th><th>LocomotiveType</th><th>last_inspected</th><th>inspection_status</th><th>cost</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row["TrainID"] . "</td><td>" . $row["InspectorSSN"] . "</td><td>" . $row["BranchID"] . "</td><td>" . $row["LocomotiveType"] . "</td><td>" . $row["last_inspected"] . "</td><td>" . $row["inspection_status"] . "</td><td>" . $row["cost"] . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No results found.";
      }

    echo "<h2><b>Inspection Statuses and the Number of Trains</b></h2>";

    $sqltraubsx = "SELECT inspection_status, COUNT(*) as count FROM Train WHERE last_inspected IS NOT NULL GROUP BY inspection_status";
    $result = mysqli_query($mysqli, $sqltraubsx);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>Inspection Status</th><th>Count</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>" . $row["inspection_status"] . "</td><td>" . $row["count"] . "</td></tr>";
        }
        echo "</table>";
      } else {
        echo "No results found.";
      }
      
}
?>

<h1>Return</h1>
    <form action='search.php' method="POST">
        <input type='submit' name= 'return' id="return" required/> <br> <br>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["return"])) {
        header("Location: home.php");
        exit;
    }
         ?>
</body>
</html>
