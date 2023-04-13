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
    <title>Train Database</title>
</head>

<body bgcolor="FBB917">
<?php
$tablesResult = mysqli_query($mysqli, "SHOW TABLES");
$tables = mysqli_fetch_all($tablesResult, MYSQLI_ASSOC);
?>

<h1>Generate Repair/Service Report</h1>
<form action='generatereportteng.php' method="POST">
    <input type='submit' name= 'freport' id="freport" value="Generate Report" required/> <br> <br>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["freport"])) {

    // Display Table of Train Engineers
    echo "<h2>List of Train Engineers</h2>";
    $sqltraubs = "SELECT * FROM Employee JOIN trainengineer ON trainengineer.essn = Employee.ssn";
    $result = mysqli_query($mysqli, $sqltraubs);
    if (mysqli_num_rows($result) > 0) {
    echo "<table border='4'><tr><th>EngineerSSN</th><th>CEOSSN</th><th>FirstName</th><th>MiddleName</th><th>LastName</th><th>Salary</th><th>Sex</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["SSN"] . "</td><td>" . $row["CEOSSN"] . "</td><td>" .  $row["FirstName"] . "</td><td>" . $row["MiddleName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["Salary"] . "</td><td>" . $row["Sex"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}

    // Display List of Trains that need to be repaired
    echo "<h2>List of Trains that need to be repaired</h2>";
    $sqltraubs = "SELECT * FROM Train WHERE inspection_status = 'Bad'";
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

    echo "<h2>List of Parts and Repair/Service Orders</h2>";
    $sqlparts = "SELECT * FROM parts AS P JOIN repairservice AS R ON P.TrainID = R.TrainID";
    $result = mysqli_query($mysqli, $sqlparts);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='4'><tr><th>Part Number</th><th>Part Name</th><th>Supplier Name</th><th>Train ID</th><th>Repair ID</th><th>EngineerSSN</th><th</tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["PartNumber"] . "</td><td>" . $row["PartName"] . "</td><td>" . $row["SupplierName"] . "</td><td>" . $row["TrainID"] . "</td><td>" . $row["RepairID"] . "</td><td>" . $row["ESSN"] . "</td></tr>";
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
    // Retrieve the input data to display

    }


         ?>
</body>
</html>
